<?php

use Illuminate\Database\Seeder;

class OptionProductTableSeeder extends Seeder
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
        
        for($i=0;$i<600;$i++){
            $check = true;
            $option_id = rand(1,2);
            $product_id = rand(1,100);
            $option_value = rand(1,5);
            foreach($arr as $it){
                if($it['option_id'] == $option_id && $it['product_id'] == $product_id && $it['option_value'] == $option_value){
                    $check = false;
                    break;
                }
            }
            if($check){
                $arr[] = [
                    "option_id" => $option_id,
                    "product_id" => $product_id,
                    "option_value" => $option_value,
                ];
            }
        }
        DB::table('option_product')->insert($arr);
    }
}
