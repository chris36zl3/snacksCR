<?php

use Illuminate\Database\Seeder;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $producto = new \App\Producto([
            'codigo' => 'PAP',
            'nombre' => 'Papas',
            'descripcion' => 'Papas tostadas',
            'precio' => 300,
            'cantidad' => 50
        ]);
        $producto->save();

        $producto = new \App\Producto([
            'codigo' => 'BOL',
            'nombre' => 'Boli',
            'descripcion' => 'Bolis diferentes sabores',
            'precio' => 150,
            'cantidad' => 50
        ]);
        $producto->save();

        $producto = new \App\Producto([
            'codigo' => 'GEL',
            'nombre' => 'Gelatina',
            'descripcion' => 'Gelatinas Artesanales',
            'precio' => 200,
            'cantidad' => 50
        ]);
        $producto->save();

        $producto = new \App\Producto([
            'codigo' => 'COC',
            'nombre' => 'Coca Cola',
            'descripcion' => 'Coca Cola normal o zero',
            'precio' => 350,
            'cantidad' => 50
        ]);
        $producto->save();

        $producto = new \App\Producto([
            'codigo' => 'AGU',
            'nombre' => 'Agua',
            'descripcion' => 'Botella de Agua',
            'precio' => 300,
            'cantidad' => 50
        ]);
        $producto->save();
    }
}
