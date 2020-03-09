<?php

use Illuminate\Database\Seeder;

class GroupDetailTableSeeder extends Seeder
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
        for($i=1;$i<35;$i++){
            $arr[] = [
                "product_id" => $i,
                "group_id" => rand(1,2),
            ];
        }
        DB::table('group_detail')->insert($arr);
    }
}
