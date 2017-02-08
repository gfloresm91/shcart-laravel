<?php

use Illuminate\Database\Seeder;

class BrandCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $contadorcategoria = 1;
        $condicioncategoria = 1;
        for ($i=1; $i <= 15; $i++) { 
            for ($j= $contadorcategoria; $j <= $condicioncategoria+4 ; $j++) { 
                DB::table('brand_categories')->insert([
                    ['categories_id' => $i, 'brand_id' => $j]
                ]);
            }
            $contadorcategoria++;
            $condicioncategoria++;
            $contadorcategoria += 4;
            $condicioncategoria += 4;

            /*if($contadorcategoria > 20)
            {
                $contadorcategoria = 1;
                $condicioncategoria = 1;
            }*/
        }
    }
}
