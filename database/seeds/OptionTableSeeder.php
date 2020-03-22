<?php

use Illuminate\Database\Seeder;

class OptionTableSeeder extends Seeder
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
                'name' => "Size",
                'type' => "select",
            ],
            [
                'name' => "Color",
                'type' => "select",
            ],
        );
        DB::table('option')->insert($arr);
    }
}
