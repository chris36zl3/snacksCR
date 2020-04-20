<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User([
            'identificacion' => '116900900',
            'nombre' => 'Andrés',
            'apellidos' => 'Vega Núñez',
            'email' => 'a@gmail.com',
            'password' => bcrypt('123456'),
            'acreditado' => 1
        ]);
        $user->save();
    }
}
