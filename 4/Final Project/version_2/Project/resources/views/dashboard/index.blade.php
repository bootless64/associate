@extends('layouts.app')

@section('title')
    <title>داشبورد</title>
@endsection

@section('style')
    @if ( config('app.env') === 'local' )
        <link href="{{ asset('css/dashboard/index.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('css/dashboard/index.css') }}?v={{ filemtime(config('app.server_css_files_path') . '/dashboard/index.css') }}" rel="stylesheet">
    @endif

    @yield('dashboard_style')
@endsection

@section('content')

    <div class="d-flex">

        <!-- دکمه فقط در صفحات کوچک و متوسط نمایش داده شود -->
        <button class="btn btn-primary d-lg-none position-fixed top-50 end-0 translate-middle-y"
            id="menuButton" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
            منو >
        </button>

        <!-- Sidebar -->
        <div class="offcanvas-lg offcanvas-end d-flex flex-column flex-shrink-0 p-2 bg-light border" tabindex="-1"
            id="sidebarMenu">

            <div class="offcanvas-header d-lg-none justify-content-end">
                <button type="button" class="btn-close text-reset m-0" data-bs-dismiss="offcanvas"
                    data-bs-target="#sidebarMenu" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body p-0">
                <ul class="nav nav-pills flex-column w-100 pe-0 pt-lg-3 text-center">

                    <li class="nav-item border-bottom">
                        <a href="{{ route('dashboard.my-profile.index') }}"
                            class="nav-link {{ Route::is('dashboard.my-profile.index') ? 'bg-secondary bg-opacity-25' : '' }}">
                            پروفایل من
                        </a>
                    </li>


                    @php
                        $user = auth()->user();
                    @endphp

                    @if($user->can('manage_users') || $user->can('manage_roles') || $user->can('manage_projects') || $user->can('manage_news') || $user->can('manage_articles') || $user->can('manage_sliders') || $user->can('manage_comments') || $user->can('manage_tickets') || $user->can('manage_logs'))

                        <li class="nav-item border-bottom">
                            <a class="nav-link" data-bs-toggle="collapse" href="#managementPanel" role="button">
                                <b>پنل مدیریت</b>
                            </a>
                            <div id="managementPanel" class="collapse">
                                <ul class="list-unstyled px-0 pb-3">
                                    @can('manage_users')
                                        <li class="nav-item border-bottom">
                                            <a href="{{ route('dashboard.manage-users.index') }}"
                                                class="nav-link {{ Route::is('dashboard.manage-users.index') ? 'bg-secondary bg-opacity-25' : '' }}">
                                                مدیریت کاربران
                                            </a>
                                        </li>
                                    @endcan

                                    @can('manage_roles')
                                        <li class="nav-item border-bottom">
                                            <a href="{{ route('dashboard.manage-roles.index') }}"
                                                class="nav-link {{ Route::is('dashboard.manage-roles.index') ? 'bg-secondary bg-opacity-25' : '' }}">
                                                مدیریت نقش‌ها
                                            </a>
                                        </li>
                                    @endcan

                                    @can('manage_projects')
                                        <li class="nav-item border-bottom">
                                            <a href="{{ route('dashboard.manage-projects.index') }}"
                                                class="nav-link {{ Route::is('dashboard.manage-projects.index') ? 'bg-secondary bg-opacity-25' : '' }}">
                                                مدیریت پروژه‌ها
                                            </a>
                                        </li>
                                    @endcan

                                    @can('manage_news')
                                        <li class="nav-item border-bottom">
                                            <a href="{{ route('dashboard.manage-news.index') }}"
                                                class="nav-link {{ Route::is('dashboard.manage-news.index') ? 'bg-secondary bg-opacity-25' : '' }}">
                                                مدیریت خبرها
                                            </a>
                                        </li>
                                    @endcan

                                    @can('manage_articles')
                                        <li class="nav-item border-bottom">
                                            <a href="{{ route('dashboard.manage-articles.index') }}"
                                                class="nav-link {{ Route::is('dashboard.manage-articles.index') ? 'bg-secondary bg-opacity-25' : '' }}">
                                                مدیریت مقاله‌ها
                                            </a>
                                        </li>
                                    @endcan

                                    @can('manage_sliders')
                                        <li class="nav-item border-bottom">
                                            <a href="{{ route('dashboard.manage-sliders.index') }}"
                                                class="nav-link {{ Route::is('dashboard.manage-sliders.index') ? 'bg-secondary bg-opacity-25' : '' }}">
                                                مدیریت اسلایدرها
                                            </a>
                                        </li>
                                    @endcan

                                    @can('manage_comments')
                                        <li class="nav-item border-bottom">
                                            <a href="{{ route('dashboard.manage-comments.index') }}"
                                                class="nav-link {{ Route::is('dashboard.manage-comments.index') ? 'bg-secondary bg-opacity-25' : '' }}">
                                                مدیریت کامنت‌ها
                                            </a>
                                        </li>
                                    @endcan

                                    @can('manage_tickets')
                                        <li class="nav-item border-bottom">
                                            <a href="{{ route('dashboard.manage-tickets.index') }}"
                                                class="nav-link {{ Route::is('dashboard.manage-tickets.index') ? 'bg-secondary bg-opacity-25' : '' }}">
                                                مدیریت تیکت‌ها
                                            </a>
                                        </li>
                                    @endcan

                                    @can('manage_logs')
                                        <li class="nav-item border-bottom">
                                            <a href="{{ route('dashboard.manage-logs') }}" target="_blank"
                                                class="nav-link {{ Route::is('dashboard.manage-logs') ? 'bg-secondary bg-opacity-25' : '' }}">
                                                مدیریت لاگ‌های سیستم
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>

                    @endif


                    @can('submit_news')
                        <li class="nav-item border-bottom">
                            <a href="{{ route('dashboard.submit-news.create') }}"
                                class="nav-link {{ Route::is('dashboard.submit-news.create') ? 'bg-secondary bg-opacity-25' : '' }}">
                                ثبت خبر
                            </a>
                        </li>
                    @endcan

                    <li class="nav-item border-bottom">
                        <a href="{{ route('dashboard.requests.index') }}"
                            class="nav-link {{ Route::is('dashboard.requests.index') ? 'bg-secondary bg-opacity-25' : '' }}">
                            درخواست‌ها
                        </a>
                    </li>

                    <li class="nav-item border-bottom">
                        <a href="{{ route('dashboard.my-projects.index') }}"
                            class="nav-link {{ Route::is('dashboard.my-projects.index') ? 'bg-secondary bg-opacity-25' : '' }}">
                            پروژه‌های من
                        </a>
                    </li>

                    @can('manage_support_tickets')
                        <li class="nav-item border-bottom">
                            <a href="{{ route('dashboard.manage-support-tickets.index') }}"
                                class="nav-link {{ Route::is('dashboard.manage-support-tickets.index') ? 'bg-secondary bg-opacity-25' : '' }}">
                                تیکت‌های پشتیبانی
                            </a>
                        </li>
                    @endcan

                    <li class="nav-item border-bottom">
                        <a href="{{ route('dashboard.my-tickets.index') }}"
                            class="nav-link {{ Route::is('dashboard.my-tickets.index') ? 'bg-secondary bg-opacity-25' : '' }}">
                            تیکت‌های من
                        </a>
                    </li>

                    @can('submit_article')
                        <li class="nav-item border-bottom">
                            <a href="{{ route('dashboard.my-articles.index') }}"
                                class="nav-link {{ Route::is('dashboard.my-articles.index') ? 'bg-secondary bg-opacity-25' : '' }}">
                                مقاله‌های من
                            </a>
                        </li>
                    @endcan

                </ul>
            </div>

        </div>




        @section('dashboard_content')

            <div class="w-100 p-4">
                <div class="page-path mb-3">
                    <a href="{{ route('home') }}">صفحه اصلی</a><span class="px-1"> > </span>
                    <a href="#">داشبورد</a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="container col-sm-6 p-3" style="min-height: 75vh;">
                    <div class="row justify-content-center card">

                        <div class="card-header">{{ __('Dashboard') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{ __('You are logged in!') }}
                        </div>

                    </div>
                </div>
            </div>

        @show

    </div>

@endsection


@section('script')
    @yield('dashboard_script')
@endsection
