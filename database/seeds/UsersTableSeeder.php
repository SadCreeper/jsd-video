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
            'motto' => '生活可以随心所欲，但不能随波逐流',
            'isAdmin' => 1,
            'created_at' => Carbon::now(),
        ]);
    }
}
