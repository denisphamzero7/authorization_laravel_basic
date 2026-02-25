<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define full permissions for Admin
        $fullPermissions = [
            'users' => ['view', 'add', 'edit', 'delete', 'permission'],
            'groups' => ['view', 'add', 'edit', 'delete', 'permission'],
            'posts' => ['view', 'add', 'edit', 'delete', 'permission'],
        ];

        DB::table('groups')->insert([
            [
                'name' => 'Administrator',
                'description' => 'Toàn quyền hệ thống',
                'permissions' => json_encode($fullPermissions),
                'user_id' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Editor',
                'description' => 'Quản lý bài viết',
                'permissions' => json_encode([
                    'posts' => ['view', 'add', 'edit', 'delete'],
                ]),
                'user_id' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Subscriber',
                'description' => 'Người dùng đăng ký',
                'permissions' => json_encode([
                    'posts' => ['view'],
                ]),
                'user_id' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
