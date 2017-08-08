<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nickname' => 'Admin',
            'password' => bcrypt('admin'),
            'email' => 'admin@qq.com',
            'phone' => 15011001100,
            'gender' => 1,
            'avatar' => 'img/avatar.jpg',
            'isAdmin' => 1,
            'created_at' => Carbon::now(),
        ]);
    }
}
