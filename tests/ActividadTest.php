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
            ->type('str','nombre')
            /* ->see('Planes')
            ->see('1 clase')
            ->see('8 clases')
            ->see('12 clases')
            ->see('20 clases')
            ->select('on','check1')
            
            ->type(80,'precio1')
            ->select('on','check2')
            ->type(80,'precio2') */
            ->see('Guardar')
            ->see('Cancelar')
            ->press('Guardar')
            ->seePageIs('actividad')
            ->see('id')
            ->see('nombre')
            ->see('estado')
            ->see('Editar')
            ->see('Eliminar');
        /* $this->seeInDatabase('actividad', [
                'nombre'=>'strong',
                'estado'=>'Activa'
                ]); */
    }

    public function test_buscar_actividad_en_lista()
    {

        $this->visit(route('actividad.index'))
             ->type('str','searchText')
             ->press('Buscar')
             ->seeInElement("table",'str')
             ->type('Telas','searchText')
             ->press('Buscar')
             ->dontSeeInElement("table",'Telas');
            
    }

    public function test_modificar_planes_de_actividad()
    {
        $this->visit('actividad/1/edit')
        ->see('Editar Actividad')
        ->select('8 clases', 'plan')
        ->see('Cantidad')
        ->type(90, 'precio')
        ->press('btn_add')
        ->seeInElement("planes",'8 clases')
        ->press('btn_eliminar')
        ->dontSeeInElement("planes",'1 clase')
        ->see('Guardar')
        ->see('Cancelar')
        ->press('Guardar')
        ->seePageIs('/actividad');
    }

}
