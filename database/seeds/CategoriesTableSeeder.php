<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=1; $i <= 5; $i++) { 
            $category = new \shcart\Categories(
            [
                'nombre'=>'Categoria '. $i
            ]);
            $category->save();
        }
        
    }
}
