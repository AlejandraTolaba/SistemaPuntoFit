<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use sisPuntoFit\Inscripcion;

class InscripcionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_crear_inscripcion()
    {
        $this->visit('/alumno/inscripcion/create/3')
            ->see('Nueva Inscripción')
            ->see('nombre')
            ->see('fecha_inscripcion')
            ->select(1,'idactividad')
            ->select(0,'idplan')
            ->see('precio')
            ->select(2,'idforma_de_pago')
            ->type(400,'monto')
            ->see('Guardar')
            ->see('Cancelar')
            ->press('Guardar');
            
        $this->seeInDatabase('inscripcion', [
            /* 'fecha_inscripcion'=>'2019-07-07',
            'fecha_vencimiento_inscripcion'=>'2019-08-07', */
            'idalumno'=>3,
            'idforma_de_pago'=>2,
            'idactividad'=>1,
            'cantidad_clases'=>8,
            'monto'=>400.00,
            'estado'=>'Activa'
            ]);
    }
}
