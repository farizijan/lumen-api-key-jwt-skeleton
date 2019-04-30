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
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@nomail.com',
            'password' => app('hash')->make('admin123'),
            'api_token' => str_random(100)
        ]);

    }
}
