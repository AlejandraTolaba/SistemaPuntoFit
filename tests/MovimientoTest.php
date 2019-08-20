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
            ->type('Inscripción N°2','concepto')
            ->type('2019-08-12','fecha')
            ->select('INGRESO','tipo')
            ->select(2,'idforma_de_pago')
            ->type(450.50,'monto')
            ->see('Guardar')
            ->see('Cancelar')
            ->press('Guardar');

            $this->seeInDatabase('movimiento_de_caja', [
                'fecha'=>'2019-08-12',
                'concepto'=>'Inscripción N°2',
                'tipo'=>'INGRESO',
                'idforma_de_pago'=>2,
                'monto'=>450.50
            ]);
    }
    public function test_listar_movimiento()
    {
        $this->visit(route('movimiento.index'))
            ->see('Movimientos del 19-08-2019')
            ->see('desde')
            ->see('hasta')
            ->see('filtrar')
            ->see('$1450.50')
            ->see('$450.00')
            ->see('$1000.5')
            ->see('Concepto')
            ->see('Fecha')
            ->see('Hora')
            ->see('Tipo')
            ->see('Forma de pago')
            ->see('Monto')
                ->seeInElement("table",'Inscripción N°1')
                ->seeInElement("table",'19-08-2019')
                ->seeInElement("table",'21:11')
                ->seeInElement("table",'INGRESO')
                ->seeInElement("table",'Contado')
                ->seeInElement("table",'$450.50')
                ->seeInElement("table",'Venta de barritas')
                ->seeInElement("table",'19-08-2019')
                ->seeInElement("table",'20:08')
                ->seeInElement("table",'INGRESO')
                ->seeInElement("table",'Contado')
                ->seeInElement("table",'$1000.00')
                ->seeInElement("table",'Pago profesor de Funcional mes de julio')
                ->seeInElement("table",'19-08-2019')
                ->seeInElement("table",'20:11')
                ->seeInElement("table",'EGRESO')
                ->seeInElement("table",'Contado')
                ->seeInElement("table",'$450.00')
            ->see('Volver')
            ->click('Volver');
    }
    public function test_listar_movimiento_desde_hasta()
    {
        $this->visit('movimiento')
            ->type('2019-08-13', 'desde' )
            ->type('2019-08-19', 'hasta' )
            ->press('filtrar')
            ->see('Movimientos desde 13-08-2019 hasta 19-08-2019')
            ->see('$1450.50')
            ->see('$450.00')
            ->see('$1000.5')
                ->seeInElement("table",'Inscripción N°1')
                ->seeInElement("table",'19-08-2019')
                ->seeInElement("table",'21:11')
                ->seeInElement("table",'Contado')
                ->seeInElement("table",'$450.50')
                ->seeInElement("table",'Pago profesor de Funcional mes de julio')
                ->seeInElement("table",'19-08-2019')
                ->seeInElement("table",'20:11')
                ->seeInElement("table",'EGRESO')
                ->seeInElement("table",'Contado')
                ->seeInElement("table",'$450.00')
                ->seeInElement("table",'Venta de barritas')
                ->seeInElement("table",'19-08-2019')
                ->seeInElement("table",'20:08')
                ->seeInElement("table",'INGRESO')
                ->seeInElement("table",'Contado')
                ->seeInElement("table",'$1000.00')
                ->seeInElement("table",'Pago profesor de Zumba')
                ->seeInElement("table",'15-08-2019')
                ->seeInElement("table",'19:55')
                ->seeInElement("table",'EGRESO')
                ->seeInElement("table",'Tarjeta de crédito')
                ->seeInElement("table",'$400.00')
                ->seeInElement("table",'Pago profesor de Funcional')
                ->seeInElement("table",'13-08-2019')
                ->seeInElement("table",'19:55')
                ->seeInElement("table",'EGRESO')
                ->seeInElement("table",'Tarjeta de crédito')
                ->seeInElement("table",'$400.00')
                ->dontSeeInElement("table",'Inscripción N°2')
                ->dontSeeInElement("table",'12-08-2019')
            ->see('Volver')
            ->click('Volver');
    }
    

}
