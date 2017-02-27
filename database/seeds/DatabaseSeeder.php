<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProductTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(BrandTableSeeder::class);
        $this->call(BrandCategoriesTableSeeder::class);
        $this->call(BrandProductTableSeeder::class);
        $this->call(ImageTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
