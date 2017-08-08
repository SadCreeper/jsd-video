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
        DB::table('users')->insert([
            'nickname' => 'SadCreeper',
            'password' => bcrypt('admin'),
            'email' => '87826632@qq.com',
            'phone' => 15008437193,
            'gender' => 1,
            'avatar' => 'img/avatar.jpg',
            'motto' => '生活可以随心所欲，但不能随波逐流aaa',
            'isAdmin' => 0,
            'created_at' => Carbon::now(),
        ]);
        //factory(App\Models\User::class, 50)->create();
    }
}
