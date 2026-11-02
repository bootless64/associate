<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    // protected function create(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // }



    public function validateRegisterData(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:25'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'mobile_number' => ['required', 'regex:/^09\d{9}$/', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'regex:/[A-Z]/', 'confirmed'],
            'captcha' => ['required', 'captcha:flat'],
        ]);

        // ذخیره موقت اطلاعات در session
        Session::put('register_data', $request->only('name', 'email', 'password', 'mobile_number'));
        //بازنشانی session
        Session::forget('mobile_verification_attempts');
        Session::put('mobile_verification_expires_at', now()->addMinutes(5));


        return $this->sendVerificationCode($request);
    }



    public function sendVerificationCode(Request $request)
    {
        $result = $this->sendViaSms($request);

        if(! $result['status']) {
            return back()->withErrors(['mobile_number' => $result['message']]);
        }

        return redirect()->route('register.verify-mobile-number.index');
    }



    public function resendVerificationCode(Request $request)
    {
        $result = $this->sendViaSms($request);

        if(! $result['status']) {
            return back()->with('error', $result['message']);
        }

        return back()->with('success', $result['message']);
    }



    public function sendViaSms(Request $request)
    {
        $lastSent = Session::get('last_verification_code_sent_at');

        if($lastSent && now()->diffInSeconds($lastSent) < 120) {
            return ['status' => false, 'message' => 'کد لحظاتی پیش ارسال شده است، لطفا قبل از درخواست مجدد چند لحظه صبر کنید.'];
        }

        // تولید و ارسال کد تایید
        $code = rand(100000, 999999);

        Session::put('mobile_verification_code', $code);
        Session::put('last_verification_code_sent_at', now());

        // ارسال کد با سرویس پیامکی (مثلاً Kavenegar یا SMS.ir)
        session()->flash('debug', 'کد تایید شماره موبایل: '.$code);

        return ['status' => true, 'message' => 'کد پیامکی به موبایل شما ارسال شد.'];
    }



    public function verifyCode(Request $request)
    {
        if(now()->gt(Session::get('mobile_verification_expires_at'))) {
            return back()->withErrors(['code' => 'زمان وارد کردن کد به پایان رسیده است. لطفا دوباره فرم عضویت را پر کنید.']);
        }

        $attempts = Session::get('mobile_verification_attempts', 0);
        if($attempts >= 3) {
            return back()->withErrors(['code' => 'تعداد تلاش‌ها بیشتر از حد مجاز است. لطفا دوباره فرم عضویت را پر کنید.']);
        }

        $request->validate([
            'code' => 'required|digits:6',
        ]);

        if ($request->code != Session::get('mobile_verification_code')) {

            $attempts++;
            Session::put('mobile_verification_attempts', $attempts);

            if($attempts >= 3) {
                return back()->withErrors(['code' => 'تعداد تلاش‌ها بیشتر از حد مجاز است. لطفا دوباره فرم عضویت را پر کنید.']);
            }
            return back()->withErrors(['code' => 'کد وارد شده نادرست است.']);
        }

        $data = Session::get('register_data');

        // ایجاد کاربر پس از تایید موفق
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile_number' => $data['mobile_number'],
            'password' => Hash::make($data['password']),
        ]);

        $user->syncRoles(['user']);

        auth()->login($user);

        // حذف اطلاعات از session
        Session::forget([
            'register_data',
            'mobile_verification_code',
            'last_verification_code_sent_at',
            'mobile_verification_expires_at',
            'mobile_verification_attempts',
        ]);

        return redirect('/dashboard');
    }
}
