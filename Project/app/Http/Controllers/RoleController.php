<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // ۱) نمایش صفحه‌ی manage-roles با داده‌های لازم
    public function manageRoles()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $rolePermissions = $roles->mapWithKeys(
                fn($role) => [
                    $role->id => $role->permissions->pluck('name')->toArray(),
                ],
            )
            ->toArray();

        return view('dashboard.manage-roles', compact('roles', 'permissions', 'rolePermissions'));
    }


    // ۲) ایجاد نقش جدید
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|regex:/^[a-zA-Z ]+$/|unique:roles,name,',
            'permissions' => 'sometimes|array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        $role = Role::create(['name' => $validated['name'], 'guard_name' => 'web']);

        if (!empty($validated['permissions'])){
            $role->syncPermissions($validated['permissions']);
        }

        return back()->with('success', 'نقش جدید با موفقیت اضافه شد.');
    }


    // ۳) بروزرسانی نام و دسترسی‌های یک نقش
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|regex:/^[a-zA-Z ]+$/|unique:roles,name,' . $role->id,
            'permissions' => 'sometimes|array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        // آپدیت نام
        $role->name = $validated['name'];
        $role->save();

        // همگام‌سازی permissions (ممکن است empty array باشد)
        $role->syncPermissions($validated['permissions'] ?? []);

        return back()->with('success', 'تغییرات نقش با موفقیت ذخیره شد.');
    }


    // ۴) حذف یک نقش
    public function destroy(Role $role)
    {
        $role->delete();

        return back()->with('success', 'نقش مورد نظر حذف شد.');
    }

}
