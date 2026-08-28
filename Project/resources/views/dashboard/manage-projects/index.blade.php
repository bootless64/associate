@extends('dashboard.index')

@section('title')
    <title>مدیریت پروژه‌ها</title>
@endsection

@section('dashboard_content')

    <div class="container py-4">

        <h2 class="mb-4">مدیریت پروژه‌ها</h2>

        {{-- پیام موفقیت --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <a class="btn btn-outline-success mb-5" href="{{ route('dashboard.manage-projects.create') }}">
            ایجاد پروژه جدید
        </a>

        {{-- فرم فیلتر/جستجو --}}
        <form method="GET" action="{{ route('dashboard.manage-projects.index') }}" class="row g-2 mb-4">
            <div class="col-lg-2 col-md-6">
                <input type="text" name="id" class="form-control" placeholder="ID پروژه" value="{{ request('id') }}">
            </div>
            <div class="col-lg-2 col-md-6">
                <input type="text" name="title" class="form-control" placeholder="موضوع پروژه"
                    value="{{ request('title') }}">
            </div>
            <div class="col-lg-3 col-md-6">
                <input type="text" name="client_name" class="form-control" placeholder="نام مشتری پروژه"
                    value="{{ request('client_name') }}">
            </div>
            <div class="col-lg-3 col-md-6">
                <input type="text" name="manager_name" class="form-control" placeholder="نام مسئول پروژه"
                    value="{{ request('manager_name') }}">
            </div>
            <div class="col-lg-2">
                <button class="btn btn-primary w-100">جستجو</button>
            </div>
        </form>




        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>موضوع پروژه</th>
                    <th>نام مشتری</th>
                    <th>نام مسئول پروژه</th>
                    <th>امکانات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td class="text-break">{{ $project->title }}</td>
                        <td>{{ $project->client->name }}</td>
                        <td>{{ $project->manager->name ?? '-' }}</td>

                        <td>
                            <a href="{{ route('project.show', $project->id) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                مشاهده پروژه
                            </a>
                            <a href="{{ route('dashboard.manage-projects.edit', $project->id) }}" class="btn btn-outline-success btn-sm mt-1 mt-md-0">
                                ویرایش
                            </a>
                            {{-- Delete Form --}}
                            <form method="POST" action="{{ route('dashboard.manage-projects.destroy', $project->id) }}"
                                class="d-inline" onsubmit="return confirm('آیا از حذف این پروژه مطمئن هستید؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger mt-1 mt-xl-0">حذف</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">هیچ پروژه‌ای یافت نشد.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {{ $projects->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>

    </div>

@endsection
