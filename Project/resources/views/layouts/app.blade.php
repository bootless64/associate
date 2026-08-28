@extends('master')

@section('meta')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

{{-- @section('title')
    <title>{{ config('app.name', 'Laravel') }}</title>
@endsection --}}

{{-- @section('style')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
@endsection --}}


@section('master_content')
    <div id="app">

        <main>
            @yield('content')
        </main>

    </div>
@endsection


@section('script')
    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
@endsection
