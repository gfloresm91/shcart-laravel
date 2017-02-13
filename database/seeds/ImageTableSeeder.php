<?php

use Illuminate\Database\Seeder;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i= 1; $i <= 125; $i++) { 
            for ($j=1; $j <= 6; $j++) { 
                $imagen = new \shcart\Image(
                [   
                    'product_id' => $i,
                    'rutaimagen' => 'https://placehold.it/255x237'
                ]);
                $imagen->save();
            }
        }
    }
}
