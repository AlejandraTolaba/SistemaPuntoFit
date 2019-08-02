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

    public function test_listar_alumnos(){
        $this->visit('alumno')
            ->see('Listado de Alumnos')
            ->see('Nombre')
            ->see('DNI')
            ->see('Teléfono')
            ->see('Estado')
            ->see('Saldo')
                ->seeInElement('.text-danger', 470)
                ->dontSeeInElement('.text-danger', -470);
    }

    public function test_buscar_alumno_en_lista()
    {

        $this->visit(route('alumno.index'))
             ->type('Emilse','searchText')
             ->press('Buscar')
             ->seeInElement("table",'Emilse')
             ->type('Sofia','searchText')
             ->press('Buscar')
             ->dontSeeInElement("table",'Sofia');
            
    }
    
    public function test_historial_inscripcion_de_alumno()
    {
        $this->visit('/alumno/inscripcion/2')
        ->see('Inscripciones de')
        ->see('Agregar')
        ->see('Actividad')
        ->see('Plan')
        ->see('Fecha de vencimiento')
        ->see('Clases restantes')
        ->see('Saldo')
        ->see('Estado');
        /* ->seeInElement("table",'Spinning')
        ->seeInElement("table",'12 Clases')
        ->seeInElement("table",'2019-08-17')
        ->seeInElement("table", 12)
        ->seeInElement("table",0.00)
        ->seeInElement("table",'Activa'); */
    }

    public function test_modificar_datos_de_un_alumno()
    {
        $this->visit('alumno/1/edit')
            ->see('Editar Alumno/a: Mirian Aldana Quispe')
            ->type('Vaqueros 123', 'domicilio' )
            ->type('156854921', 'telefono_celular' )
            ->type('4921678', 'numero_contacto' )
            ->type('mimi@gmail.com', 'email' )
            ->select('1','certificado')
            ->type('2019-07-30', 'fecha_certificado' )
            ->type('', 'observaciones' )
            ->type('Lunes, martes, miercoles', 'rutina' )
            ->see('Guardar')
            ->see('Cancelar')
            ->press('Guardar')
            ->seePageIs('alumno');
            $this->seeInDatabase('alumno', [
                'domicilio'=>'Vaqueros 123',
                'telefono_celular'=>'156854921',
                'numero_contacto'=>'4921678',
                'email'=>'mimi@gmail.com',
                'certificado'=>1,
                'fecha_certificado' => '2019-07-30',
                'observaciones'=>'',
                'rutina'=>'Lunes, martes, miercoles'
                ]);
    }
}