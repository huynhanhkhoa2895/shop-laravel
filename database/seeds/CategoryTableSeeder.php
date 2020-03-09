<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = array(
            [
                'name' => "Shoes",
                'route' => "shoes.html"
            ],
            [
                'name' => "T-Shirt",
                'route' => "tshirt.html"
            ],
        );
        DB::table('category')->insert($arr);
    }
}
