@extends('master')

@section('title')
    <title>مقاله‌ها</title>
@endsection

@section('style')
    @if ( config('app.env') === 'local' )
        <link href="{{ asset('css/articles/index.css')}}" rel="stylesheet">
    @else
        <link href="{{ asset('css/articles/index.css') }}?v={{ filemtime('/home/ctfsadja/public_html/css/articles/index.css') }}" rel="stylesheet">
    @endif
@endsection

@section('master_content')

    <div class="container mt-5 mb-5">

        <h2 class="mb-5 text-center">مقاله‌های منتشر شده</h2>

        <div class="row">
            @foreach ($articles as $item)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-lg">
                        <img src="{{ $item->image ? asset('storage/articles/' . $item->image) : asset('image/no-image.jpg') }}" class="card-img-top" alt="{{ $item->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">{{ Str::limit( strip_tags($item->content), 300, '...' ) }}</p>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('article.show', $item->id) }}" class="btn btn-primary">مشاهده مقاله</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $articles->links('pagination::bootstrap-5') }}
        </div>
    </div>

@endsection
