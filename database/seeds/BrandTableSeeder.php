<?php

use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=1; $i <= 25; $i++) { 
            $marca = new \shcart\Brand(
            [
                'nombre'=>'Marca '.$i,
            ]);
            $marca->save();
        }
    }
}
