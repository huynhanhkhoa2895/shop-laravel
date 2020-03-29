<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            CategoryTableSeeder::class,
            BrandTableSeeder::class,
            GroupTableSeeder::class,
            ProductTableSeeder::class,
            GroupDetailTableSeeder::class,
            ImageTableSeeder::class,
            OptionTableSeeder::class,
            OptionValueTableSeeder::class,
            OptionProductTableSeeder::class,
        ]);
    }
}
