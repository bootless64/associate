@extends('dashboard.index')

@section('title')
    <title>مقاله‌های من</title>
@endsection

@section('dashboard_style')
    @if ( config('app.env') === 'local' )
        <link href="{{ asset('css/dashboard/my-articles/index.css')}}" rel="stylesheet">
    @else
        <link href="{{ asset('css/dashboard/my-articles/index.css') }}?v={{ filemtime('/home/ctfsadja/public_html/css/dashboard/my-articles/index.css') }}" rel="stylesheet">
    @endif
@endsection

@section('dashboard_content')

    <div class="container mt-5 mb-5 px-5">

        <h2 class="mb-5 text-center">مقاله‌های من</h2>

        {{-- پیام موفقیت --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <a class="btn btn-outline-success mb-5" href="{{ route('dashboard.my-articles.create') }}">
            انتشار مقاله جدید
        </a>

        <div class="row">
            @foreach ($my_articles as $item)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-lg">
                        <img src="{{ $item->image ? asset('storage/articles/' . $item->image) : asset('image/no-image.jpg') }}" class="card-img-top" alt="{{ $item->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">{{ Str::limit( strip_tags($item->content), 300, '...' ) }}</p>

                            <a href="{{ route('article.show', $item->id) }}" target="_blank" class="btn btn-outline-primary m-1">مشاهده مقاله</a>

                            <a href="{{ route('dashboard.my-articles.edit', $item->id) }}" class="btn btn-outline-success">ویرایش</a>

                            {{-- Delete Form --}}
                            <form method="POST" action="{{ route('dashboard.my-articles.destroyOwnArticle', $item->id) }}"
                                class="d-inline" onsubmit="return confirm('آیا از حذف این مقاله مطمئن هستید؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger m-1">حذف</button>
                            </form>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $my_articles->links('pagination::bootstrap-5') }}
        </div>
    </div>

@endsection
