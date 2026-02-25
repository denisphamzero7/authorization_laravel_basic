<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('modules')->insert([
            [
                'name' => 'users',
                'title' => 'Quản lý người dùng',
                'description' => 'Quản lý người dùng',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'groups',
                'title' => 'Quản lý nhóm',
                'description' => 'Quản lý nhóm',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'posts',
                'title' => 'Quản lý bài viết',
                'description' => 'Quản lý bài viết',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
