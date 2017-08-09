<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => '琴棋书画',
            'created_at' => Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => '民间艺术',
            'created_at' => Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => '节日习俗',
            'created_at' => Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => '中医药学',
            'created_at' => Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => '童年记忆',
            'created_at' => Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => '家乡风光',
            'created_at' => Carbon::now(),
        ]);
    }
}
