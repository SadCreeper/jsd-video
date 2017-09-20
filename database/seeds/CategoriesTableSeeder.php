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
        $created_at = Carbon::now()
        DB::table('categories')->insert([
            ['name' => '琴棋书画', 'created_at' => $created_at],
            ['name' => '民间艺术', 'created_at' => $created_at],
            ['name' => '节日习俗', 'created_at' => $created_at],
            ['name' => '中医养生', 'created_at' => $created_at],
            ['name' => '童年记忆', 'created_at' => $created_at],
            ['name' => '家乡多娇', 'created_at' => $created_at],
        ]);
    }
}
