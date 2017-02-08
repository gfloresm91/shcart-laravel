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
        //Productos en oferta
        $product = new \shcart\Product(
            [
                'rutaimagen'=>'http://placehold.it/255x237',
                'titulo' => 'Producto 1',
                'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore, nesciunt eos totam sit saepe odit, numquam voluptatem officia beatae deserunt iure similique! Hic nihil illum sit dolorum blanditiis quaerat dolores.',
                'precio' => 50000,
                'oferta' => true
            ]);
        $product->save();

        $product = new \shcart\Product(
            [
                'rutaimagen'=>'http://placehold.it/255x237',
                'titulo' => 'Producto 2',
                'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore, nesciunt eos totam sit saepe odit, numquam voluptatem officia beatae deserunt iure similique! Hic nihil illum sit dolorum blanditiis quaerat dolores.',
                'precio' => 2000,
                'oferta' => true
            ]);
        $product->save();

        $product = new \shcart\Product(
            [
                'rutaimagen'=>'http://placehold.it/255x237',
                'titulo' => 'Producto 3',
                'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore, nesciunt eos totam sit saepe odit, numquam voluptatem officia beatae deserunt iure similique! Hic nihil illum sit dolorum blanditiis quaerat dolores.',
                'precio' => 10000,
                'oferta' => true
            ]);
        $product->save();

        //Productos comunes
        for ($i=4; $i <= 125; $i++) { 
            $product = new \shcart\Product(
            [
                'rutaimagen'=>'http://placehold.it/255x237',
                'titulo' => 'Producto '.$i,
                'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore, nesciunt eos totam sit saepe odit, numquam voluptatem officia beatae deserunt iure similique! Hic nihil illum sit dolorum blanditiis quaerat dolores.',
                'precio' => (1000 * $i)+10,
                'oferta' => false
            ]);
            $product->save();
        }
    }
}
