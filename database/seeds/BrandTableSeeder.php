<?php

use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arr = array(
            [
                'name' => "Nike",
                'logo' => "nike.png",
                'include_menu' => 0,
                'route' => "nike.html",
            ],
            [
                'name' => "Adidas",
                'logo' => "adidas.png",
                'include_menu' => 0,
                'route' => "adidas.html",
            ],
        );
        DB::table('brand')->insert($arr);
    }
}
