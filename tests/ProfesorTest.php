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
            ->type('Maria', 'nombrea' )
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

    public function test_modificar_datos_de_un_profesor()
    {
        $this->visit('profesor/2/edit')
            ->see('Editar datos de María Ibarra')
            ->type('María Beatriz','nombrea')
            ->type('40157997','dni')
            ->type('San Lorenzo','domicilio')
            ->type('154426788','telefono_celular')
            ->type('4921679','numero_contacto')
            ->type('maryb@gmail.com','email')
            ->see('Confirmar')
            ->see('Cancelar')
            ->press('Confirmar')
            ->seePageIs('profesor');
            $this->seeInDatabase('profesor', [
                'nombre'=>'María Beatriz',
                'dni' => '40157997',
                'domicilio' => 'San Lorenzo',
                'telefono_celular' => '154426788',
                'numero_contacto' => '4921679',
                'email' => 'maryb@gmail.com'
                ]);
    }

    public function test_ver_datos_de_un_profesor()
    {
        $this->visit('profesor/1')
            ->see('DATOS PERSONALES')
            ->see('Nombre: María Gutierres', 'nombre')
            ->see('DNI: 35762123', 'dni')
            ->see('Fecha de Nacimiento: 10-09-2016','fecha_nacimiento')
            ->see('Sexo: Femenino','sexo')
            ->see('Domicilio: Vaqueros', 'domicilio' )
            ->see('Telefono: 154426787', 'telefono' )
            ->see('Contacto: 4253711', 'contacto' )
            ->see('Email: mary@gmail.com', 'email' )
            ->see('Volver')
            ->click('Volver');
    }
    public function test_deshabilitar_profesor()
    {
        $this->visit('profesor')
        ->see('Maria Ibarra')
        ->click("Deshabilitar-5")
        ->see('Deshabilitar Profesor')
        ->see('Confirme si desea deshabilitar el profesor')
        ->press('Confirmar-5');
        $this->seeInDatabase('profesor', [
            'idprofesor' => 5,
            'nombre' => 'Maria',
            'apellido' => 'Ibarra',
            'estado' => 'Inactivo'
            ]);
    }

    /* public function test_habilitar_profesor()
    {
        $this->visit('profesor')
        ->see('Maria Ibarra')
        ->press('Habilitar-4');
        $this->seeInDatabase('profesor', [
            'idprofesor' => 4,
            'estado' => 'Activo'
            ]);
    } */
}
