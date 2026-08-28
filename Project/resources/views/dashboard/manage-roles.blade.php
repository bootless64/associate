@extends('dashboard.index')

@section('title')
    <title>مدیریت نقش‌ها</title>
@endsection

@section('dashboard_content')

    <div class="container py-4">

        <h2 class="mb-4">مدیریت نقش‌ها</h2>

        {{-- پیام موفقیت --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        {{-- بخش ایجاد نقش جدید --}}
        <button class="btn btn-outline-success mb-3" data-bs-toggle="collapse" data-bs-target="#createRoleForm">
            ایجاد نقش جدید
        </button>
        <div class="collapse mb-5" id="createRoleForm">
            <form method="POST" action="{{ route('dashboard.manage-roles.store') }}" class="row g-2">
                @csrf
                <div class="col-md-4">
                    <input name="name" class="form-control" placeholder="نام نقش به انگلیسی" value="" required>
                </div>


                <div class="row gx-2 m-3">
                    {{-- چک‌لیست permissions --}}
                    <div class="mb-2"><b>دسترسی‌ها</b>: </div>
                    @foreach ($permissions as $perm)
                        <div class="col-md-4">
                            <div class="form-check w-50">
                                <input class="form-check-input border-dark" type="checkbox" name="permissions[]"
                                    value="{{ $perm->name }}"
                                    id="newPerm_{{ $perm->id }}"
                                    {{ in_array($perm->name, old('permissions', [])) ? 'checked' : '' }}>
                                <label class="form-check-label"
                                    for="newPerm_{{ $perm->id }}">
                                    {{ $perm->fa_name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>



                <div class="col-auto">
                    <button class="btn btn-primary">ثبت</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="collapse"
                        data-bs-target="#createRoleForm">
                        انصراف
                    </button>
                </div>
            </form>
        </div>





        {{-- جدول نقش‌ها --}}
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>نام نقش</th>
                    <th>تعداد دسترسی</th>
                    <th>امکانات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{ count($rolePermissions[$role->id] ?? []) }}</td>
                        <td class="py-0">
                            @if ($role->name !== 'admin' && $role->name !== 'user')
                                {{-- ویرایش --}}
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="collapse"
                                    data-bs-target="#editRole{{ $role->id }}">
                                    ویرایش
                                </button>
                                {{-- حذف --}}
                                <form method="POST" action="{{ route('dashboard.manage-roles.destroy', $role) }}" class="d-inline-block"
                                    onsubmit="return confirm('آیا از حذف این نقش اطمینان دارید؟');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">حذف</button>
                                </form>
                            @endif

                        </td>
                    </tr>

                    {{-- فرم ویرایش درجا --}}
                    <tr class="bg-light" >
                        <td colspan="3" class="p-0">

                            <div class="collapse" id="editRole{{ $role->id }}">
                                <div class="card border-0">
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('dashboard.manage-roles.update', $role) }}">
                                            @csrf @method('PATCH')

                                            <div class="row gx-2 mb-3">
                                                {{-- تغییر نام --}}
                                                <div class="col-md-4 d-flex align-items-center">
                                                    <label class="ms-3">نام نقش: </label>
                                                    <input type="text" name="name" class="form-control w-50"
                                                        value="{{ $role->name }}" required>
                                                </div>
                                            </div>

                                            <div class="row gx-2">
                                                {{-- چک‌لیست permissions --}}
                                                <div class="mb-2"><b>دسترسی‌ها</b>: </div>
                                                @foreach ($permissions as $perm)
                                                    <div class="col-md-4">
                                                        <div class="form-check w-50">
                                                            <input class="form-check-input border-dark" type="checkbox" name="permissions[]"
                                                                value="{{ $perm->name }}"
                                                                id="perm_{{ $role->id }}_{{ $perm->id }}"
                                                                {{ in_array($perm->name, $rolePermissions[$role->id] ?? []) ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="perm_{{ $role->id }}_{{ $perm->id }}">
                                                                {{ $perm->fa_name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            {{-- دکمه‌های ذخیره و انصراف --}}
                                            <div class="mt-3">
                                                <button class="btn btn-sm btn-success">ذخیره</button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                                    data-bs-toggle="collapse" data-bs-target="#editRole{{ $role->id }}">
                                                    انصراف
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
