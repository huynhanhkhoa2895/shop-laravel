<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return User::forceCreate([
            'name' => "admin",
            'email' => "a8515895@gmail.com",
            'password' => Hash::make(123456),
        ]);
    }
}
