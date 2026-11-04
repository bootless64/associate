<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //نقش‌های پیش‌فرض
        $defaultRoles = ['admin', 'user', 'support'];
        foreach ($defaultRoles as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }

        //پرمیشن‌های پایه
        $defaultPermissions = [
            ['name' => 'manage users', 'fa_name' => 'مدیریت کاربران'],
            ['name' => 'manage roles', 'fa_name' => 'مدیریت نقش‌ها'],
            ['name' => 'manage projects', 'fa_name' => 'مدیریت پروژه‌ها'],
            ['name' => 'manage news', 'fa_name' => 'مدیریت خبرها'],
            ['name' => 'manage articles', 'fa_name' => 'مدیریت مقاله‌ها'],
            ['name' => 'manage comments', 'fa_name' => 'مدیریت کامنت‌ها'],
            ['name' => 'manage tickets', 'fa_name' => 'مدیریت تیکت‌ها'],
            ['name' => 'manage own articles', 'fa_name' => 'مدیریت مقاله‌های خود'],
        ];

        foreach ($defaultPermissions as $permName) {
            Permission::firstOrCreate(['name' => $permName['name'], 'fa_name'=> $permName['fa_name'], 'guard_name' => 'web']);
        }

        $defaultPermissionsNames = array_column($defaultPermissions, 'name');

        //دسترسی های مدیر
        $admin = Role::findByName('admin');
        $admin->syncPermissions($defaultPermissionsNames);

        //دسترسی های پشتیبان
        $support = Role::findByName('support');
        $support->syncPermissions(['manage comments', 'manage tickets']);

        //دسترسی های کاربر
        //..

        User::all()->each(function ($user) {
            if($user->role && Role::where('name', $user->role)->exists()){
                $user->syncRoles($user->role);
            }
        });
    }
}
