<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Productos comunes
        for ($i=1; $i <= 125; $i++) { 
            $product = new \shcart\Product(
            [   
                'titulo' => 'Producto '.$i,
                'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore, nesciunt eos totam sit saepe odit, numquam voluptatem officia beatae deserunt iure similique! Hic nihil illum sit dolorum blanditiis quaerat dolores.',
                'precio' => (1000 * $i)+10,
            ]);
            if($i <= 3)
            {
                $product->oferta = true;
            }
            if($i > 120){
                $product->condicion = 'Nuevo';
            }
            $product->save();
        }
    }
}
