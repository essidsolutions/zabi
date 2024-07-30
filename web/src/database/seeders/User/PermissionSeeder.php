<?php

namespace Database\Seeders\User;

use App\Models\Quran\Permission\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

//            dhikrs Seeder
            [
                'name' => 'view_dhikrs',
                'group_name' => 'dhikrs',
            ],
            [
                'name' => 'create_dhikrs',
                'group_name' => 'dhikrs',
            ],
            [
                'name' => 'update_dhikrs',
                'group_name' => 'dhikrs',
            ],
            [
                'name' => 'delete_dhikrs',
                'group_name' => 'dhikrs',
            ],
            [
                'name' => 'view_dua',
                'group_name' => 'dua',
            ],
            [
                'name' => 'create_dua',
                'group_name' => 'dua',
            ],
            [
                'name' => 'update_dua',
                'group_name' => 'dua',
            ],
            [
                'name' => 'delete_dua',
                'group_name' => 'dua',
            ],
            [
                'name' => 'view_sifats',
                'group_name' => 'sifats',
            ],
            [
                'name' => 'create_sifats',
                'group_name' => 'sifats',
            ],
            [
                'name' => 'update_sifats',
                'group_name' => 'sifats',
            ],
            [
                'name' => 'delete_sifats',
                'group_name' => 'sifats',
            ],
            [
                'name' => 'view_haram_codes',
                'group_name' => 'haram_code',
            ],
            [
                'name' => 'create_haram_codes',
                'group_name' => 'haram_code',
            ],
            [
                'name' => 'update_haram_codes',
                'group_name' => 'haram_code',
            ],
            [
                'name' => 'delete_haram_codes',
                'group_name' => 'haram_code',
            ],
            [
                'name' => 'view_prayer_times',
                'group_name' => 'prayer_time',
            ],
            [
                'name' => 'create_prayer_times',
                'group_name' => 'prayer_time',
            ],
            [
                'name' => 'update_prayer_times',
                'group_name' => 'prayer_time',
            ],
            [
                'name' => 'delete_prayer_times',
                'group_name' => 'prayer_time',
            ],
            [
                'name' => 'view_roles',
                'group_name' => 'role',
            ],
            [
                'name' => 'create_roles',
                'group_name' => 'role',
            ],
            [
                'name' => 'update_roles',
                'group_name' => 'role',
            ],
            [
                'name' => 'delete_roles',
                'group_name' => 'role',
            ],
            [
                'name' => 'view_users',
                'group_name' => 'user',
            ],
            [
                'name' => 'delete_users',
                'group_name' => 'user',
            ],
            [
                'name' => 'invite_user',
                'group_name' => 'user',
            ],
            [
                'name' => 'view_setting',
                'group_name' => 'setting',
            ],
            [
                'name' => 'update_setting',
                'group_name' => 'setting',
            ],
            [
                'name' => 'view_email_setting',
                'group_name' => 'setting',
            ],
            [
                'name' => 'update_email_setting',
                'group_name' => 'setting',
            ],
        ];

        Permission::query()->insert($permissions);
    }
}
