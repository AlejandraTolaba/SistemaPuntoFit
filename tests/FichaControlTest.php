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

    public function test_listar_fichas_de_alumno(){
        $this->visit('alumno/fichaControlCorporal/7')
            ->see('Fichas de Control Corporal de Rocio Tolaba')
            ->see('Fecha')
            ->see('Peso')
            ->see('Edad Corporal')
            ->see('IMC')
            ->see('Grasa Corporal')
            ->see('IMM')
            ->see('MB')
            ->see('Grasa Visceral');
    }

    public function test_modificar_datos_de_una_ficha()
    {
        $this->visit('alumno/fichaControlCorporal/1/edit')
            ->see('Editar Ficha de Control Corporal')
            ->type(46,'peso')
            ->type(21.1,'imc')
            ->type(25,'edad_corporal')
            ->type(20.4,'grasa_corporal')
            ->type(21.5,'imm')
            ->type(20,'mb')
            ->type(21,'grasa_viceral')
            ->see('Confirmar')
            ->see('Cancelar')
            ->press('Confirmar')
            ->seePageIs('alumno/fichaControlCorporal/1');
            $this->seeInDatabase('ficha_control', [
                'peso'=>46,
                'imc' => 21.1,
                'edad_corporal' => 25,
                'grasa_corporal' => 20.4,
                'imm' => 21.5,
                'mb' => 20,
                'grasa_viceral' => 21
                ]);
    }

    public function test_eliminar_ficha()
    {
        $this->visit('alumno/fichaControlCorporal/1')
        ->click('Eliminar-2')
        ->see('Eliminar Ficha de Control Corporal')
        ->see('Confirme si desea eliminar la ficha')
        ->press('Confirmar-2');
        $this->dontSeeInDatabase('ficha_control', ['fecha_registro' => '2019-08-01']);
    }
}
