<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Disable foreign key checks to truncate tables and insert data
        Schema::disableForeignKeyConstraints();

        // Truncate tables
        DB::table('posts')->truncate();
        DB::table('users')->truncate();
        DB::table('groups')->truncate();
        DB::table('modules')->truncate();

        // Call Seeders in order
        $this->call([
            ModuleSeeder::class,
            GroupSeeder::class,
            UserSeeder::class,
            PostSeeder::class,
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
