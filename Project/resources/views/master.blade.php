<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta')

    @yield('title')

    <link href="{{ asset('bootstrap-5.3.3/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    @if ( config('app.env') === 'local' )
        <link href="{{ asset('css/master.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('css/master.css') }}?v={{ filemtime('/home/ctfsadja/public_html/css/master.css') }}" rel="stylesheet">
    @endif

    @yield('style')

</head>


<body>
    <nav id="nav" class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top p-0">
        <div class="container-fluid px-1">
            <a class="navbar-brand" href="{{ route('home') }}">
                <div class="d-flex" id="logo"><img src="{{ asset('icon/logo-white-name.png') }}"
                        class="img-fluid p-1" alt="logo"></div>
            </a>

            <button class="navbar-toggler ms-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <div class="d-flex">
                    <ul class="navbar-nav px-2">
                        <li class="nav-item">
                            <a class="nav-link me-2" href="{{ route('home') }}">صفحه اصلی</a>
                        </li>

                        <li class="nav-item dropdown dropdown-hover position-relative">
                            <a class="nav-link me-2 dropdown-toggle" href="#" id="hoverDropdown" role="button"
                                aria-expanded="false">
                                رسالت ما
                            </a>
                            <ul class="dropdown-menu dropdown-hover-menu text-end" aria-labelledby="hoverDropdown">
                                <li><a class="dropdown-item" href="{{ route('vision-and-goal') }}">اهداف و ماموریت‌ها</a></li>
                                <li><a class="dropdown-item" href="{{ route('missions') }}">سیاست‌ها</a></li>
                                <li><a class="dropdown-item" href="{{ route('work-organization') }}">سازمان کاری</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown dropdown-hover position-relative">
                            <a class="nav-link me-2 dropdown-toggle" href="#" id="hoverDropdown" role="button"
                                aria-expanded="false">
                                قوانین
                            </a>
                            <ul class="dropdown-menu dropdown-hover-menu text-end" aria-labelledby="hoverDropdown">
                                <li><a class="dropdown-item" href="#">قوانین و دستورالعمل‌ها</a></li>
                                <li><a class="dropdown-item" href="#">آیین نامه‌های اجرایی</a></li>
                                <li><a class="dropdown-item" href="#">ضوابط و مقررات</a></li>
                                <li><a class="dropdown-item" href="#">آیین نامه‌های داخلی</a></li>
                                <li><a class="dropdown-item" href="#">فرم‌های عملیاتی</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown dropdown-hover position-relative">
                            <a class="nav-link me-2 dropdown-toggle" href="#" id="hoverDropdown" role="button"
                                aria-expanded="false">
                                پروژه‌ها
                            </a>
                            <ul class="dropdown-menu dropdown-hover-menu text-end" aria-labelledby="hoverDropdown">
                                <li><a class="dropdown-item" href="{{ route('projects.titles') }}">عناوین</a></li>
                                <li><a class="dropdown-item" href="#">مستندات</a></li>
                                <li><a class="dropdown-item" href="#">تاریخچه کار</a></li>
                                <li><a class="dropdown-item" href="#">درخواست</a></li>
                                <li><a class="dropdown-item" href="{{ route('projects.progress') }}">پیشرفت پروژه</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown dropdown-hover position-relative">
                            <a class="nav-link me-2 dropdown-toggle" href="#" id="hoverDropdown" role="button"
                                aria-expanded="false">
                                آکادمی توانمندسازی کارگاهی
                            </a>
                            <ul class="dropdown-menu dropdown-hover-menu text-end" aria-labelledby="hoverDropdown">
                                <li><a class="dropdown-item" href="#">حوزه تنظیم و پایش اسناد</a></li>
                                <li><a class="dropdown-item" href="#">حوزه تست‌های امنیتی و نفوذ</a></li>
                                <li><a class="dropdown-item" href="#">حوزه تطبیق با آیین‌نامه‌های اجرایی افتا</a></li>
                                <li><a class="dropdown-item" href="#">حوزه رفع خطاهای امنیتی نرم‌افزار</a></li>
                                <li><a class="dropdown-item" href="#">استاندارد ISO/IEC15408</a></li>
                                <li><a class="dropdown-item" href="#">استاندارد ISO/IEC25000</a></li>
                                <li><a class="dropdown-item" href="#">سایر استانداردهای ISO/IEC</a></li>
                                <li><a class="dropdown-item" href="#">استاندارد ISMS</a></li>
                                {{-- <li><a class="dropdown-item" href="#">حوزه مهندسی نرم‌افزار</a></li> --}}
                                <li><a class="dropdown-item" href="#">استعدادیابی و برگزاری رویداد</a></li>
                                <li><a class="dropdown-item" href="#">کارآفرینی و ترویج امنیت سایبری</a></li>
                                <li><a class="dropdown-item" href="#">خدمات مشاوره در رابطه با چگونگی اخذ مجوز افتا</a></li>
                                <li><a class="dropdown-item" href="#">منتورینگ، کوچینگ و توانمندسازی نیروی انسانی</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown dropdown-hover position-relative">
                            <a class="nav-link me-2 dropdown-toggle" href="#" id="hoverDropdown"
                                role="button" aria-expanded="false">
                                علمی
                            </a>
                            <ul class="dropdown-menu dropdown-hover-menu text-end" aria-labelledby="hoverDropdown">
                                <li><a class="dropdown-item" href="#">پژوهش‌های ملی/بین‌المللی</a></li>
                                <li><a class="dropdown-item" href="#">مقالات ملی/بین‌المللی</a></li>
                                <li><a class="dropdown-item" href="#">پژوهش‌های بومی</a></li>
                                <li><a class="dropdown-item" href="{{ route('articles') }}">مقالات بومی</a></li>
                                <li><a class="dropdown-item" href="#">تحقیق و توسعه</a></li>
                                <li><a class="dropdown-item" href="#">پیشنهاد مقاله/پایان نامه/رساله</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link me-2" href="{{ route('news') }}">خبرها</a>
                        </li>

                    </ul>


                    <form class="d-flex me-4 align-items-center">
                        <input class="form-control" id="formInput" type="text" placeholder="جستجو کنید...">
                        <button class="btn btn-primary" type="button" id="searchBtn">
                            <div id="searchIcon"><img src="{{ asset('icon/search-white.svg') }}" class="img-fluid"
                                    alt="search"></div>
                        </button>
                    </form>



                    {{-- only for guests --}}
                    @guest
                        <div id="loginRegisterLinks" class="d-flex align-items-center me-4">
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="btn btn-primary ms-2 d-flex justify-content-center align-items-center">ورود</a>
                            @endif

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-success d-flex justify-content-center align-items-center">عضویت</a>
                            @endif
                        </div>

                    {{-- for users --}}
                    @else
                        <ul class="navbar-nav p-0 me-4 mb-lg-0 mb-3">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end text-center account-dropdown"
                                    aria-labelledby="navbarDropdown">

                                    @auth
                                        <div class="mb-1 mx-auto dropdown-avatar">
                                            <img src="{{ auth()->user()->avatar ? asset('storage/avatars/' . auth()->user()->avatar) : asset('image/no-avatar.png') }}"
                                                class="img-fluid dropdown-avatar">
                                        </div>

                                        <a class="dropdown-item" href="{{ route('dashboard.index') }}">
                                            {{ __('Dashboard') }}
                                        </a>
                                    @endauth


                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    @endguest

                </div>
            </div>
        </div>
    </nav>




    @yield('master_content')




    <footer class="bg-dark text-white py-2">
        <br>
        <div class="container">
            <div class="row gy-4">

                <div class="col-md-4 text-center">
                    <h5 class="mb-2">لینک‌های مفید</h5>

                    <ul class="list-unstyled p-0 useful-links">
                        <li><a href="https://afta.gov.ir" target="_blank" class="text-white">مرکز مدیریت راهبردی افتا</a></li>
                        <li><a href="https://ito.gov.ir" target="_blank" class="text-white">سازمان فناوری اطلاعات ایران</a></li>
                        <li><a href="https://naciportal.inso.gov.ir" target="_blank" class="text-white">مرکز ملی تایید صلاحیت</a></li>
                        <li><a href="https://isti.ir" target="_blank" class="text-white">معاونت علمی پژوهشی فناوری ریاست جمهوری</a></li>
                        <li><a href="https://www.bmn.ir" target="_blank" class="text-white">بنیاد ملی نخبگان</a></li>
                    </ul>
                </div>

                <div class="col-md-4 text-center">
                    <h5 class="mb-2">پیوست‌ها</h5>

                    <ul class="list-unstyled p-0">
                        <li><a href="{{ route('about-us') }}" class="text-white">درباره ما</a></li>
                        <li><a href="#" class="text-white">سوالات متداول</a></li>
                    </ul>
                </div>

                <div class="col-md-4 text-center">
                    <h5 class="mb-2">ما را دنبال کنید:</h5>

                    <div class="d-flex justify-content-center">
                        <a href="#">
                            <div class="footer-icon">
                                <img src="{{ asset('icon/aparat-white.svg') }}" class="img-fluid">
                            </div>
                        </a>
                        <a href="#">
                            <div class="footer-icon">
                                <img src="{{ asset('icon/linkedin-white.svg') }}" class="img-fluid">
                            </div>
                        </a>
                        <a href="#">
                            <div class="footer-icon">
                                <img src="{{ asset('icon/telegram-white.svg') }}" class="img-fluid">
                            </div>
                        </a>
                        <a href="#">
                            <div class="footer-icon">
                                <img src="{{ asset('icon/whatsapp-white.svg') }}" class="img-fluid">
                            </div>
                        </a>
                        <a href="#">
                            <div class="footer-icon">
                                <img src="{{ asset('icon/eitaa-white.svg') }}" class="img-fluid">
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <div class="text-center mt-md-0 mt-3">
            <p>
                <span class="fs-5">© </span>
                تمامی حقوق مادی و معنوی این سایت متعلق به مرکز پژوهشی آسا شرق می‌باشد.
            </p>
        </div>

    </footer>


    <script src="{{asset('bootstrap-5.3.3/dist/js/bootstrap.bundle.min.js')}}"></script>

    @yield('script')


</body>

</html>
