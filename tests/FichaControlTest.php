<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FichaControlTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     * @test
     */

    use DatabaseMigrations;


    public function test_agregar_ficha_control_corporal_de_alumno()
    {
        $this->visit('/alumno/fichaControlCorporal/create/1')
        ->see('Nueva Ficha de Control Corporal')
        ->see('Nombre: Mirian Aldana Quispe','nombre')
        ->see('Fecha: 01-08-2019','fecha')
        ->type(50.500 ,'peso')
        ->type(21.9,'imc')
        ->type(40,'edad_corporal')
        ->type(40,'grasa_corporal')
        ->type(40,'imm')
        ->type(40,'mb')
        ->type(40,'grasa_viceral')
        ->see('Guardar')
        ->see('Cancelar')
        ->press('Guardar');
    $this->seeInDatabase('ficha_control', [
        'idalumno'=>1,
        'peso'=>50.500,
        'imc'=>21.9,
        'edad_corporal'=>40,
        'grasa_corporal'=>40,
        'imm'=>40,
        'mb'=>40,
        'grasa_viceral'=>40
        ]);
    }
}
