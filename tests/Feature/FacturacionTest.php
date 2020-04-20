<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FacturacionTest extends TestCase
{
    use RefreshDatabase;

    public function testFuncionamientoFactura()
    {
        $data =  [
            'cantidad' => '2',
            'producto_id' => '5'
        ];
        $this->post(route('add.venta'), $data)->assertStatus(201);

        $data1 =  [
            'cantidad' => 2,
            'producto_id' => 1
        ];
        $this->post(route('add.venta'), $data1)->assertStatus(201);
    }

    public function testValidacionFactura()
    {
        $data =  [
            'cantidad' => -1,
            'producto_id' => 3
        ];
        $this->post(route('add.venta'), $data)->assertStatus(422);
    }

    public function testValidacionFactura1()
    {
        $data =  [
            'cantidad' => 1,
            'producto_id' => 3
        ];
        $this->post(route('add.venta'), $data)->assertStatus(422);
    }
}
