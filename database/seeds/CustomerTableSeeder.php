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
        $arr = array([
            'name' => "customer",
            'email' => "customer@gmail.com",
            'password' => Hash::make(123456),
            'state' => "",
            'phone' => "",
            'address' => "",
        ],[
            'name' => "customer 2",
            'email' => "customer2@gmail.com",
            'password' => Hash::make(123456),
            'state' => "1",
            'phone' => "0335076638",
            'address' => "854 tạ quang bửu",
        ],[
            'name' => "customer 3",
            'email' => "customer3@gmail.com",
            'password' => Hash::make(123456),
            'state' => "1",
            'phone' => "0335076638",
            'address' => "856 tạ quang bửu",
        ]);
        DB::table('customer')->insert($arr);
    }
}
