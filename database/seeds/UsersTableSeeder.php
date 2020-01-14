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
            'name' => 'Bart',
            'lastname' => 'Hamming',
            'st_number' => '123456',
            'email' => 'b.hamming@windesheim.nl',
            'email_verified_at' => '2019-05-18 13:36:16',
            'password' => bcrypt('ADOndernemen2019!'),
            'active' => 1
        ]);
    }
}
