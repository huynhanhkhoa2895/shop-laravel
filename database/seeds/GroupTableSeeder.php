<?php

use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
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
                'name' => "Men",
                'route' => "men.html"
            ],
            [
                'name' => "Woman",
                'route' => "woman.html"
            ],
        );
        DB::table('group')->insert($arr);
    }
}
