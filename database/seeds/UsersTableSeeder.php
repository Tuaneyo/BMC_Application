<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::create([
            'name' => 'Tuan',
            'lastname' => 'Nguyen',
            'st_number' => '123456',
            'email' => 'tuan@gmail.com',
            'email_verified_at' => '2019-05-18 13:36:16',
            'password' => bcrypt('Admin123'),
            'active' => 1
        ]);
    }
}
