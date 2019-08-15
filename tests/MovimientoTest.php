<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MovimientoTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_registrar_movimiento()
    {
        $this->visit('movimiento/create')
            ->see('Nuevo Movimiento')
            ->type('Pago profesor de Funcional mes de JULIO','concepto')
            ->type('2019-08-13','fecha')
            ->select('EGRESO','tipo')
            ->select(2,'idforma_de_pago')
            ->type(400,'monto')
            ->see('Guardar')
            ->see('Cancelar')
            ->press('Guardar');

            $this->seeInDatabase('movimiento_de_caja', [
                'fecha'=>'2019-08-13',
                'concepto'=>'Pago profesor de Funcional mes de JULIO',
                'tipo'=>'EGRESO',
                'idforma_de_pago'=>2,
                'monto'=>400.00
            ]);
    }

}
