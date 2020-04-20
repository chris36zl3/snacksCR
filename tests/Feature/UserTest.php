<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testLoginUser()
    {
        $user =  factory(User::class)->create(['password' => bcrypt('123456')]);
        $this->post(route('login'), ['email' => $user->email, 'password' => '123456'])->assertStatus(200);
    }

    public function testLoginUserFail()
    {
        $user =  factory(User::class)->create(['password' => bcrypt('123456')]);
        $this->post(route('login'), ['email' => $user->email, 'password' => 'incorrecta'])->assertStatus(400);
    }

    public function testRegisterUser()
    {
        //$user =  factory(User::class)->create(['password' => bcrypt('123456')]);
        $this->post(route('register'), [
            'identificacion' => '147414741',
            'nombre' => 'dfg',
            'apellidos' => 'gdfg',
            'email' => 'dfg@gmail.com',
            'password' => bcrypt('123456'),
            'acreditado' => '1'
        ])->assertStatus(201);
    }




}
