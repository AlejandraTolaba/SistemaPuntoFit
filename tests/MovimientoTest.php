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
            ->see('Movimientos del 29-08-2019')
            ->see('desde')
            ->see('hasta')
            ->see('filtrar')
            ->see('Concepto')
            ->see('Fecha')
            ->see('Hora')
            ->see('Tipo')
            ->see('Forma de pago')
            ->see('Monto')
            // TABLA CON LOS MOVIMIENTOS DEL DIA 29-08-2019
                ->seeInElement("table",'Inscripción N° 23')
                ->seeInElement("table",'29-08-2019')
                ->seeInElement("table",'17:55')
                ->seeInElement("table",'INGRESO')
                ->seeInElement("table",'Tarjeta de crédito')
                ->seeInElement("table",'$80.00')
                ->seeInElement("table",'Inscripción N° 22')
                ->seeInElement("table",'17:54')
                ->seeInElement("table",'$700.00')
                ->seeInElement("table",'Inscripción N° 21')
                ->seeInElement("table",'17:53')
                ->seeInElement("table",'Contado')
                ->seeInElement("table",'$900.00')
                ->seeInElement("table",'Venta de barritas')
                ->seeInElement("table",'17:52')
                ->seeInElement("table",'$100.00')
                ->seeInElement("table",'Pago a profesor de Funciona mes de julio')
                ->seeInElement("table",'17:53')
                ->seeInElement("table",'EGRESO')
                ->seeInElement("table",'$1500.00')
            // TABLA DE INGRESOS Y EGRESOS EN CONTADO
            ->seeInElement("table",'$1700.00')
            ->seeInElement("table",'$1500.00')
            // TABLA CON TODOS LOS TOTALES
            ->seeInElement("table",'$200.00')
            ->seeInElement("table",'$80.00')
            ->seeInElement("table",'$0.00')
            ->seeInElement("table",'$0.00')
            ->seeInElement("table",'$280.00')
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
            // TABLA CON LISTADO DE MOVIMIENTOS 
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
            // TABLA DE INGRESOS Y EGRESOS EN CONTADO
            ->seeInElement("table",'$1450.50')
            ->seeInElement("table",'$450.00')
            // TABLA CON TODOS LOS TOTALES
            ->seeInElement("table",'$1000.50')
            ->seeInElement("table",'$-800.00')
            ->seeInElement("table",'$0.00')
            ->seeInElement("table",'$0.00')
            ->seeInElement("table",'$200.50')
            ->see('Volver')
            ->click('Volver');
    }
}
