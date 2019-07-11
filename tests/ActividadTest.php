<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use sisPuntoFit\Actividad;

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
            ->type('as2','nombre')
            ->see('Guardar')
            ->see('Cancelar')
            ->press('Guardar')
            ->seePageIs('actividad')
            ->see('id')
            ->see('nombre')
            ->see('estado')
            ->see('Editar')
            ->see('Eliminar');
        $this->seeInDatabase('actividad', [
                'nombre'=>'as2',
                'estado'=>'Activa'
                ]);
    }

    public function test_buscar_actividad_en_lista()
    {

        $this->visit(route('actividad.index'))
             ->type('Aikido','searchText')
             ->press('Buscar')
             ->seeInElement("table",'Aikido')
             ->type('Zumba','searchText')
             ->press('Buscar')
             ->dontSeeInElement("table",'Zumba');
            
    }


}
