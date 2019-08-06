<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProfesorTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     * @test
     */

    use DatabaseMigrations;


    public function test_crear_profesor()
    {
        $this->visit('profesor/create')
            ->see('Nuevo Profesor')
            ->type('Maria', 'nombre' )
            ->type('Ibarra', 'apellido' )
            ->type(35781731, 'dni' )
            ->type('2016-09-10', 'fecha_nacimiento' )
            ->select('F','sexo')
            ->type('Ciudad del norte', 'domicilio' )
            ->type('11232', 'telefono_celular' )
            ->type('98475', 'numero_contacto' )
            ->type('Gutierres@gmail.com', 'email')
            ->see('Guardar')
            ->see('Cancelar')
            ->press('Guardar');

        $this->seeInDatabase('profesor', [
            'nombre'=>'Maria',
            'apellido'=>'Ibarra',
            'dni'=>35781731,
            'fecha_nacimiento'=>'2016-09-10',
            'sexo'=>'F',
            'domicilio'=>'Ciudad del norte',
            'telefono_celular'=>'11232',
            'numero_contacto'=>'98475',
            'email'=>'Gutierres@gmail.com',
            'estado'=>'Activo'
            ]);
    }

    public function test_listar_profesores(){
        $this->visit('profesor')
            ->see('Listado de Profesores')
            ->see('Foto')
            ->see('Nombre')
            ->see('DNI')
            ->see('Teléfono')
            ->see('Estado');
    }

    public function test_buscar_profesor_en_listado()
    {
        $this->visit(route('profesor.index'))
             ->type('Sofia','searchText')
             ->press('Buscar')
             ->seeInElement("table",'Sofia')
             ->type('Marisel','searchText')
             ->press('Buscar')
             ->dontSeeInElement("table",'Marisel');
            
    }
}
