<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VentaTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_registrar_venta()
    {
        $this->visit('venta/create')
            ->see('Nueva Venta')
            ->select(1,'producto')
            ->see('precio')
            ->see('stock')
            ->type(2,'cantidad')
            ->see('total')
            ->select(2,'idforma_de_pago')
            ->see('Guardar')
            ->see('Cancelar');
    }
}
