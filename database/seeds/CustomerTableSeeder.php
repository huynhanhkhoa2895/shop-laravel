<?php

use Illuminate\Database\Seeder;
use App\Customer;
class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        return Customer::forceCreate([
            'name' => "admin",
            'email' => "customer@gmail.com",
            'password' => Hash::make(654321),
        ]);
    }
}
