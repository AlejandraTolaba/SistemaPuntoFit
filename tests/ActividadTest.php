<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use sisPuntoFit\Actividad;
use sisPuntoFit\PlanActividad;

class ActividadTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    

    public function test_crear_actividad()
    {
        $this->visit('actividad/create')
            ->see('Nueva Actividad')
            ->type('jv','nombre')
            ->see('Planes')
            ->see('1 clase')
            ->see('8 clases')
            ->see('12 clases')
            ->see('20 clases') 
            //->select('')
            ->select('on','check1')
            //->enable('precio1')
            ->type(80,'precio1')
           /*  ->select('on','check2')
            ->type(80,'precio2')
             *//* ->select('on','check3')
            ->type('80','precio3')
            ->select('on','check4')
            ->type('80','precio4') */
            ->see('Guardar')
            ->see('Cancelar')
            ->press('Guardar')
            ->seePageIs('actividad')
            ->see('id')
            ->see('nombre')
            ->see('estado')
            ->see('Editar')
            ->see('Eliminar');
        /* $this->seeInDatabase('planactividad', [
                'nombre'=>'danzas',
                'estado'=>'activa'
                ]); */
    }

    public function test_buscar_actividad_en_lista()
    {

        $this->visit(route('actividad.index'))
             ->type('pesa','searchText')
             ->press('Buscar')
             ->seeInElement("table",'pesa')
             ->type('Telas','searchText')
             ->press('Buscar')
             ->dontSeeInElement("table",'Telas');
            
    }



}
