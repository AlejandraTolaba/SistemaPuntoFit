<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
//use Illuminate\Foundation\Testing\Browser;
//use Illuminate\Foundation\Testing\Database;
use sisPuntoFit\Alumno; 



class AlumnoTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     * @test
     */

    use DatabaseMigrations;


    public function test_crear_alumno()
    {
        $this->visit('alumno/create')
            ->see('Nuevo Alumno')
            ->see('Datos personales')
            ->type('Maria Macarena', 'nombre' )
            ->type('Gutierres', 'apellido' )
            ->type(35762123, 'dni' )
            ->type('2016-09-10', 'fecha_nacimiento' )
            ->select('F','sexo')
            ->type('Ciudad del norte', 'domicilio' )
            ->type('11232', 'telefono_celular' )
            ->type('98475', 'numero_contacto' )
            ->type('Gutierres@gmail.com', 'email' )
            ->see('Otros datos')
            ->select('SI' or 'NO','certificado')
            ->type('2019-09-09', 'fecha_certificado' )
            ->type('No tiene', 'observaciones' )
            ->see('Guardar')
            ->see('Cancelar')
            ->press('Guardar');

        $this->seeInDatabase('alumno', [
            'nombre'=>'Maria Macarena',
            'apellido'=>'Gutierres',
            'dni'=>35762123,
            'fecha_nacimiento'=>'2016-09-10',
            'sexo'=>'F',
            'domicilio'=>'Ciudad del norte',
            'telefono_celular'=>'11232',
            'numero_contacto'=>'98475',
            'email'=>'Gutierres@gmail.com',
            'observaciones'=>'No tiene',
            'certificado'=>1,
            'estado'=>'Activo'
            ])
            ->seePageIs('alumno/');
    
    }

    public function test_listar_alumno()
    {
        $this->visit('alumno')
            ->see('Listado de Alumnos')
            ->see('Nombre')
            ->see('DNI')
            ->see('Teléfono')
            ->see('Estado');
    }
    
    public function test_buscar_alumno_en_lista()
    {

        $this->visit(route('alumno.index'))
             ->type('Walter','searchText')
             ->press('Buscar')
             ->seeInElement("table",'Walter')
             ->type('Zulema','searchText')
             ->press('Buscar')
             ->dontSeeInElement("table",'Zulema');
            
    }
}
