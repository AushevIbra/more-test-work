<?php

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
        \App\User::create([
           'name' => 'Test 1',
           'email' => 'test@test.ru',
           'password' => bcrypt('password'),
        ]);
    }
}
