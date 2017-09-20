<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class ConfTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $created_at = Carbon::now();
        DB::table('conf')->insert([
            [
                'key' => 'notice',
                'value' => '',
                'intro' => '公告',
                'created_at' => $created_at ],
        ]);
    }
}
