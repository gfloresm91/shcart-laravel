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
        //
        $product = new \shcart\Product(
            [
                'rutaimagen'=>'http://lorempixel.com/255/237',
                'titulo' => 'Titulo',
                'descripcion' => 'Descripción',
                'precio' => 1000
            ]);
        $product->save();

        $product = new \shcart\Product(
            [
                'rutaimagen'=>'http://lorempixel.com/255/237',
                'titulo' => 'Titulo',
                'descripcion' => 'Descripción',
                'precio' => 12000
            ]);
        $product->save();

        $product = new \shcart\Product(
            [
                'rutaimagen'=>'http://lorempixel.com/255/237',
                'titulo' => 'Titulo',
                'descripcion' => 'Descripción',
                'precio' => 13000
            ]);
        $product->save();

        $product = new \shcart\Product(
            [
                'rutaimagen'=>'http://lorempixel.com/255/237',
                'titulo' => 'Titulo',
                'descripcion' => 'Descripción',
                'precio' => 14000
            ]);
        $product->save();

        $product = new \shcart\Product(
            [
                'rutaimagen'=>'http://lorempixel.com/255/237',
                'titulo' => 'Titulo',
                'descripcion' => 'Descripción',
                'precio' => 20000
            ]);
        $product->save();

        $product = new \shcart\Product(
            [
                'rutaimagen'=>'http://lorempixel.com/255/237',
                'titulo' => 'Titulo',
                'descripcion' => 'Descripción',
                'precio' => 30000
            ]);
        $product->save();
    }
}
