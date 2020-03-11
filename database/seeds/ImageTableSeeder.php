<?php

use Illuminate\Database\Seeder;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arr = [];
        for($i=1;$i<18;$i++){
            for($j=1;$j<4;$j++){
                $arr[] = [
                    "product_id" => $i,
                    "name" => "h".$i."_".$j.".png",
                ];
            }
        }

        DB::table('image')->insert($arr);
    }
}
