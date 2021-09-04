<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tags')->insert([
            [
                'name' => 'お知らせ',
                'slug' => 'news',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => 'リリース',
                'slug' => 'release',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => 'キャンペーン',
                'slug' => 'campaign',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        $faker = Faker::create();
        for ($i = 1; $i <= 50; $i++) {
            DB::table('post_tag')->insert([
                'post_id' => $i,
                'tag_id' => $faker->numberBetween(1, 3)
            ]);
        }
    }
}
