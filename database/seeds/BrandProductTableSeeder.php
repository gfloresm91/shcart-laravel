<?php

use Illuminate\Database\Seeder;

class BrandProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $contadorproducto = 1;
        $condicionproducto = 1;
        for ($i=1; $i <= 25; $i++) { 
            for ($j= $contadorproducto; $j <= $condicionproducto+4 ; $j++) { 
                DB::table('brand_product')->insert([
                    ['brand_id' => $i, 'product_id' => $j]
                ]);
            }
            $contadorproducto++;
            $condicionproducto++;
            $contadorproducto += 4;
            $condicionproducto += 4;

            /*if($contadorproducto > 20)
            {
                $contadorproducto = 1;
                $condicionproducto = 1;
            }*/
        }
    }
}
