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


    public function testAlumnoCreate()
    {
        $this->visit('alumno')
            ->see('Nuevo Alumno')
            ->type('Emilse', 'nombre' )
            ->type('Tolaba', 'apellido' )
            ->type('34567', 'dni' )
            ->type('2016-09-10', 'fecha_nacimiento' )
            ->select('F' or 'M','sexo')
            ->type('Domicilio', 'domicilio' )
            ->type('TelCel', 'telefono_celular' )
            //->type('Cont', 'numero_contacto' )
            //->type('ejemplo@algo', 'email' )
            ->select('SI' or 'NO','certificado')
            ->type('2016-09-09', 'fecha_certificado' )
            //->type('Observaciones', 'observaciones' )
            ->press('Guardar')
            ->seePageIs('alumno/');
            /* $this->seeInDatabase('alumno', [
                "nombre"=>"Emilse",
                "apellido"=>"Tolaba",
                "dni"=>'34567',
                "fecha_nacimiento"=>"2016-09-10",
                "sexo"=>'F',
                "domicilio"=>"Domicilio",
                "telefono_celular"=>"TelCel",
                //"numero_contacto"=>"Cont",
                //"email"=>"ejemplo@algo",
                "certificado"=>"SI",
                'fecha_certificado'=>'2016-09-09',
                //"observaciones"=>"Observaciones",
                //'fecha_alta'=>\Carbon\Carbon::now()
                "estado"=>"Activo"]); */
            
    
    }
    /*public function testCreateAlumno(){
        $alumno=factory(Alumno::class)->create();
        $this->visit('alumno/')
            ->see('Nuevo Alumno')

    }*/
    

}