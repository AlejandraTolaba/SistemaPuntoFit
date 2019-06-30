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
            ->type('pesa','nombre')
            /*->see('Planes')
             ->see('1 día')
            ->see('8 días')
            ->see('12 día')
            ->see('20 días') 
            ->see('Precio')
            //->select('')
            ->check('1 día','nombreplan')
            ->type(80,'precio')
            ->check('20 días')*/
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
                'nombre'=>'pesa',
                'estado'=>'activa'
                ]);
    }

    public function test_buscar_actividad_en_lista()
    {

        $this->visit(route('actividad.index'))
             ->type('pesa','searchText')
             ->press('Buscar')
             ->seeInElement("table",'pesa')
             ->type('Zumba','searchText')
             ->press('Buscar')
             ->dontSeeInElement("table",'Zumba');
            
    }


}
