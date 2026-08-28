@extends('dashboard.index')

@section('title')
    <title>مدیریت مقاله‌ها</title>
@endsection

@section('dashboard_content')

    <div class="container py-4">

        <h2 class="mb-4">مدیریت مقاله‌ها</h2>

        {{-- پیام موفقیت --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- فرم فیلتر/جستجو --}}
        <form method="GET" action="{{ route('dashboard.manage-articles.index') }}" class="row g-2 mb-4">
            <div class="col-lg-2 col-md-6">
                <input type="text" name="id" class="form-control" placeholder="ID مقاله" value="{{ request('id') }}">
            </div>
            <div class="col-lg-2 col-md-6">
                <input type="text" name="user_name" class="form-control" placeholder="نام منتشر کننده"
                    value="{{ request('user_name') }}">
            </div>
            <div class="col-lg-3 col-md-6">
                <input type="text" name="title" class="form-control" placeholder="عنوان مقاله"
                    value="{{ request('title') }}">
            </div>
            <div class="col-lg-3 col-md-6">
                <input type="text" name="content" class="form-control" placeholder="متن مقاله"
                    value="{{ request('content') }}">
            </div>
            <div class="col-lg-2">
                <button class="btn btn-primary w-100">جستجو</button>
            </div>
        </form>




        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>نام منتشر کننده</th>
                    <th>عنوان مقاله</th>
                    <th>امکانات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>{{ $article->user->name }}</td>
                        <td>{{ $article->title }}</td>

                        <td>
                            <a href="{{ route('article.show', $article->id) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                مشاهده مقاله
                            </a>

                            {{-- Delete Form --}}
                            <form method="POST" action="{{ route('dashboard.manage-articles.destroy', $article->id) }}"
                                class="d-inline" onsubmit="return confirm('آیا از حذف این مقاله مطمئن هستید؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger mt-1 mt-md-0">حذف</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">هیچ مقاله‌ای یافت نشد.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {{ $articles->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>

    </div>

@endsection
