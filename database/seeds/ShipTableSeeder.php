<?php

use Illuminate\Database\Seeder;

class ShipTableSeeder extends Seeder
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
            'customer_id'=>2,
            'name' => 'khoa',
            'state' => "1",
            'phone' => "0335076638",
            'address' => "243 tạ quang bửu",
        ],[
            'customer_id'=>2,
            'name' => 'khoa2',
            'state' => "1",
            'phone' => "0335076638",
            'address' => "854 tạ quang bửu",
        ],[
            'customer_id'=>2,
            'name' => 'khoa3',
            'state' => "1",
            'phone' => "09785464",
            'address' => "856 tạ quang bửu",
        ],[
            'customer_id'=>2,
            'name' => 'khoa 4',
            'state' => "1",
            'phone' => "09785464",
            'address' => "243 tạ quang bửu",
        ],[
            'customer_id'=>2,
            'name' => 'khoa5',
            'state' => "1",
            'phone' => "0335076638",
            'address' => "854 tạ quang bửu",
        ],);
        DB::table('ship')->insert($arr);
    }
}
