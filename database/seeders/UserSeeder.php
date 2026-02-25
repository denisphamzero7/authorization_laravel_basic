<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        
        // Get group IDs
        $adminGroupId = DB::table('groups')->where('name', 'Administrator')->value('id');
        $editorGroupId = DB::table('groups')->where('name', 'Editor')->value('id');
        $subscriberGroupId = DB::table('groups')->where('name', 'Subscriber')->value('id');

        // Create Admin
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'group_id' => $adminGroupId,
            'user_id' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create random users
        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('123456'),
                'group_id' => $faker->randomElement([$editorGroupId, $subscriberGroupId]),
                'user_id' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
