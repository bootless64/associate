<?php

namespace App\Http\Controllers;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function generateFakeUser()
    {
        $user = \App\Models\User::factory()->create();
        $user->syncRoles(['user']);
        return response()->json($user);
    }


    // ۱) نمایش لیست کاربران با فیلتر و صفحه‌بندی
    public function manageUsers(Request $request)
    {
        $query = User::query();

        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }
        if ($request->filled('name')) {
            $query->where('name', 'like', '%'.$request->name.'%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%'.$request->email.'%');
        }
        if ($request->filled('role')) {
            $query->where('role', $request->input('role'));
        }

        $users = $query->orderBy('id','desc')->paginate(20)
                       ->appends($request->only(['id','name','email','role']));

        $roles = Role::all();

        return view('dashboard.manage-users', compact('users','roles'));
    }



    // ۲) بروزرسانی نقش کاربر
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        if ($user->hasRole('admin') && User::role('admin')->count() <= 2) {
            return back()->with('error', 'حداقل دو مدیر باید در سیستم بمانند.');
        }

        // ذخیره در ستون role جدول users
        $user->role = $request->role;
        $user->save();

        // اختصاص نقش با Spatie
        $user->syncRoles([$request->role]);

        return back()->with('success', 'نقش کاربر به «'.$request->role.'» تغییر یافت.');
    }



    // ۳) حذف کاربر
    public function destroy(User $user)
    {
        if ($user->hasRole('admin') && User::role('admin')->count() <= 2) {
            return back()->with('error', 'حداقل دو مدیر باید در سیستم بمانند.');
        }

        if (auth()->user()->id === $user->id) {
            return abort(403);
        }

        // حذف تصویر پروفایل در صورت وجود
        if ($user->avatar && Storage::exists('public/avatars/' . $user->avatar)) {
            Storage::delete('public/avatars/' . $user->avatar);
        }

        $user->delete();
        return back()->with('success', 'کاربر حذف شد.');
    }


}
