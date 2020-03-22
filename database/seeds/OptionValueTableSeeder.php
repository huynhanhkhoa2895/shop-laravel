<?php

use Illuminate\Database\Seeder;

class OptionValueTableSeeder extends Seeder
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
                'option_id' => "1",
                'value_id' => 1,
                'value' => "S",
            ],
            [
                'option_id' => "1",
                'value_id' => 2,
                'value' => "M",
            ],
            [
                'option_id' => "1",
                'value_id' => 3,
                'value' => "X",
            ],
            [
                'option_id' => "1",
                'value_id' => 4,
                'value' => "XL",
            ],
            [
                'option_id' => "1",
                'value_id' => 5,
                'value' => "XXL",
            ],
            [
                'option_id' => "2",
                'value_id' => 1,
                'value' => "#ea0d0d",
            ],
            [
                'option_id' => "2",
                'value_id' => 2,
                'value' => "#1553d2",
            ],
            [
                'option_id' => "2",
                'value_id' => 3,
                'value' => "#f3c007",
            ],
            [
                'option_id' => "2",
                'value_id' => 4,
                'value' => "#fac",
            ],
            [
                'option_id' => "2",
                'value_id' => 5,
                'value' => "#0aa91e",
            ],
        );
        DB::table('option_value')->insert($arr);

    }
}
