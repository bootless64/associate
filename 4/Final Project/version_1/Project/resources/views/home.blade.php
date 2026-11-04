@extends('master')

@section('title')
    <title>صفحه اصلی</title>
@endsection

@section('style')
    @if ( config('app.env') === 'local' )
        <link href="{{ asset('css/home.css')}}" rel="stylesheet">
    @else
        <link href="{{ asset('css/home.css') }}?v={{ filemtime('/home/ctfsadja/public_html/css/home.css') }}" rel="stylesheet">
    @endif
@endsection

@section('master_content')

    <div class="container my-5 text-center">
        <h1><strong>مرکز پژوهشی امنیت سایبری شرق</strong></h1>
    </div>

    <div class="container">

        <section id="mainCarousel" class="carousel slide" data-bs-ride="carousel">

            <div class="carousel-indicators d-none d-md-flex">
                <button type="button" data-bs-target="#mainCarousel"
                    data-bs-slide-to="0" class="{{ 'active' }}">
                </button>
                <button type="button" data-bs-target="#mainCarousel"
                    data-bs-slide-to="1" class="{{ '' }}">
                </button>
                <button type="button" data-bs-target="#mainCarousel"
                    data-bs-slide-to="2" class="{{ '' }}">
                </button>
                <button type="button" data-bs-target="#mainCarousel"
                    data-bs-slide-to="3" class="{{ '' }}">
                </button>
                <button type="button" data-bs-target="#mainCarousel"
                    data-bs-slide-to="4" class="{{ '' }}">
                </button>
            </div>


            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('image/5x2/baner.jpg') }}" class="w-100 h-100" alt="بنر وبسایت">

                </div>
                <div class="carousel-item">
                    <img src="{{ asset('image/5x2/CTF06.jpg') }}" class="w-100 h-100" alt="مسابقه فتح پرچم">
                    <div class="carousel-caption">
                        <h3>گزارش روند اجرایی مسابقه فتح پرچم CTF در دانشگاه سجاد</h3>
                        <p class="d-sm-block d-none">این مسابقه در حوزه امنیت سایبری در چهاربخش فارنزیک، وب، شبکه و پنهان‌نگاری برگزار شد...</p>
                        <a href="/news/26" class="btn btn-primary">مشاهده خبر</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('image/5x2/CTF07.jpg') }}" class="w-100 h-100" alt="مسابقه فتح پرچم">
                    <div class="carousel-caption">
                        <h3>گزارش روند اجرایی مسابقه فتح پرچم CTF در دانشگاه سجاد</h3>
                        <p class="d-sm-block d-none">این مسابقه در حوزه امنیت سایبری در چهاربخش فارنزیک، وب، شبکه و پنهان‌نگاری برگزار شد...</p>
                        <a href="/news/26" class="btn btn-primary">مشاهده خبر</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('image/5x2/CTF04.jpg') }}" class="w-100 h-100" alt="مسابقه فتح پرچم">
                    <div class="carousel-caption">
                        <h3>گزارش روند اجرایی مسابقه فتح پرچم CTF در دانشگاه سجاد</h3>
                        <p class="d-sm-block d-none">این مسابقه در حوزه امنیت سایبری در چهاربخش فارنزیک، وب، شبکه و پنهان‌نگاری برگزار شد...</p>
                        <a href="/news/26" class="btn btn-primary">مشاهده خبر</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('image/5x2/CTF05.jpg') }}" class="w-100 h-100" alt="مسابقه فتح پرچم">
                    <div class="carousel-caption">
                        <h3>گزارش روند اجرایی مسابقه فتح پرچم CTF در دانشگاه سجاد</h3>
                        <p class="d-sm-block d-none">این مسابقه در حوزه امنیت سایبری در چهاربخش فارنزیک، وب، شبکه و پنهان‌نگاری برگزار شد...</p>
                        <a href="/news/26" class="btn btn-primary">مشاهده خبر</a>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </section>


        <br>


        <div class="my-5">
            <div class="row gy-4">
                <div class="col-lg-3 col-sm-6">
                    <div class="card shadow-lg">
                        <img src="{{ asset('image/cyber-security-07.jpg') }}" class="card-img-top" alt="پیش ممیزی">
                        <div class="card-body">
                            <h5 class="card-title text-center">پیش ممیزی</h5>
                            <p class="card-text">وفق قوانین کشور کلیه مستندات نرم‌افزارهای قابل اجرا در فضای مجازی ملزم به رعایت اصولی هستند که در این بخش پایش می‌شوند.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card shadow-lg">
                        <img src="{{ asset('image/cyber-security-10.jpg') }}" class="card-img-top" alt="پیش ارزیابی">
                        <div class="card-body">
                            <h5 class="card-title text-center">پیش ارزیابی</h5>
                            <p class="card-text">وفق قوانین کشور کلیه نرم‌افزارهای قابل اجرا در فضای مجازی ملزم به رعایت اصولی هستند که در این بخش پایش می‌شوند.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card shadow-lg">
                        <img src="{{ asset('image/cyber-security-00.jpg') }}" class="card-img-top" alt="پیش تست امنیتی و نفوذ">
                        <div class="card-body">
                            <h5 class="card-title text-center">پیش تست امنیتی و نفوذ</h5>
                            <p class="card-text">در این بخش تلاش می‌شود با انجام پیش تست‌های امنیتی و نفوذ، ضریب امنیتی نرم‌افزارهای قابل اجرا در فضای مجازی ارتقا یابد.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card shadow-lg">
                        <img src="{{ asset('image/cyber-security-02.jpg') }}" class="card-img-top" alt="پایش استانداردها">
                        <div class="card-body">
                            <h5 class="card-title text-center">پایش استانداردها</h5>
                            <p class="card-text">نرم‌افزارهای قابل اجرا در فضای مجازی الزام به رعایت مفاد استانداردهای ISO/IEC15408 و ISO/IEC25000 و ... را دارند. این بخش وضعیت ضرورت‌های استاندارد در نرم‌افزار را پایش می‌نماید.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br><br>

        <div class="my-4">
            <div class="row gy-4">
                <div class="col-lg-3 col-6">
                    <div class="text-center border rounded pt-3 px-2 shadow-lg custom-card">
                        <h4>آکادمی</h4>
                        <p>این بخش ماموریت توانمندسازی و استعدادیابی نیروی انسانی در امنیت سایبری را دارد.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="text-center border rounded pt-3 px-2 shadow-lg custom-card">
                        <h4>پروژه‌</h4>
                        <p>در این بخش گزارشات پیشرفت پروژه‌های طرف قرارداد ارائه می‌گردد.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="text-center border rounded pt-3 px-2 shadow-lg custom-card">
                        <h4>علمی</h4>
                        <p>این بخش دسترسی به منابع علمی مرتبط با امنیت سایبری را فراهم می‌نماید.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="text-center border rounded pt-3 px-2 shadow-lg custom-card">
                        <h4>فرم‌های عملیاتی</h4>
                        <p>بخش دسترسی به مجموعه کلیه فرم‌های عملیاتی مورد نیاز آزمایشگاه</p>
                    </div>
                </div>
            </div>
        </div>

        <br><br>

    </div>


@endsection

