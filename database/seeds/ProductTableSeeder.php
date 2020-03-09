<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [];
        for($i=0;$i<100;$i++){
            $name = Str::random(5);
            $arr[] = [
                "category_id" => rand(1,2),
                "brand_id" => rand(1,2),
                "name" => $name,
                "sku" => $name."_".$i,
                "price" => rand(100000,9999999),
                "route" => $name."_".$i.".html"
            ];
        }
        DB::table('product')->insert($arr);
    }
}
