<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $userIds = DB::table('users')->pluck('id')->toArray();

        if (empty($userIds)) {
            return;
        }

        for ($i = 1; $i <= 30; $i++) {
            DB::table('posts')->insert([
                'title' => $faker->sentence(),
                'content' => $faker->paragraphs(3, true),
                'user_id' => $faker->randomElement($userIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
