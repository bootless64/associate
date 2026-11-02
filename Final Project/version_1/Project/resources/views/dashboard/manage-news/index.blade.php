@extends('dashboard.index')

@section('title')
    <title>مدیریت خبرها</title>
@endsection

@section('dashboard_content')

    <div class="container py-4">

        <h2 class="mb-4">مدیریت خبرها</h2>

        {{-- پیام موفقیت --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <a class="btn btn-outline-success mb-5" href="{{ route('dashboard.manage-news.create') }}">
            انتشار خبر جدید
        </a>

        {{-- فرم فیلتر/جستجو --}}
        <form method="GET" action="{{ route('dashboard.manage-news.index') }}" class="row g-2 mb-4">
            <div class="col-lg-2 col-md-6">
                <input type="text" name="id" class="form-control" placeholder="ID خبر" value="{{ request('id') }}">
            </div>
            <div class="col-lg-2 col-md-6">
                <input type="text" name="user_name" class="form-control" placeholder="نام منتشر کننده"
                    value="{{ request('user_name') }}">
            </div>
            <div class="col-lg-3 col-md-6">
                <input type="text" name="title" class="form-control" placeholder="عنوان خبر"
                    value="{{ request('title') }}">
            </div>
            <div class="col-lg-3 col-md-6">
                <input type="text" name="content" class="form-control" placeholder="متن خبر"
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
                    <th>عنوان خبر</th>
                    <th>امکانات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($news as $one_news)
                    <tr>
                        <td>{{ $one_news->id }}</td>
                        <td>{{ $one_news->user->name }}</td>
                        <td>{{ $one_news->title }}</td>

                        <td>
                            <a href="{{ route('news.show', $one_news->id) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                مشاهده خبر
                            </a>
                            <a href="{{ route('dashboard.manage-news.edit', $one_news->id) }}" class="btn btn-outline-success btn-sm mt-1 mt-md-0">
                                ویرایش
                            </a>
                            {{-- Delete Form --}}
                            <form method="POST" action="{{ route('dashboard.manage-news.destroy', $one_news->id) }}"
                                class="d-inline" onsubmit="return confirm('آیا از حذف این خبر مطمئن هستید؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger mt-1 mt-xl-0">حذف</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">هیچ خبری یافت نشد.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {{ $news->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>

    </div>

@endsection
