<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use sisPuntoFit\Inscripcion;

class InscripcionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_crear_inscripcion()
    {
        $this->visit('/alumno/inscripcion/create/3')
            ->see('Nueva Inscripción')
            ->see('nombre')
            ->see('fecha_inscripcion')
            ->select(1,'idactividad')
            ->select(0,'idplan')
            ->see('precio')
            ->select(2,'idforma_de_pago')
            ->type(400,'monto')
            ->see('Guardar')
            ->see('Cancelar')
            ->press('Guardar');
            
        $this->seeInDatabase('inscripcion', [
            /* 'fecha_inscripcion'=>'2019-07-07',
            'fecha_vencimiento_inscripcion'=>'2019-08-07', */
            'idalumno'=>3,
            'idforma_de_pago'=>2,
            'idactividad'=>1,
            'cantidad_clases'=>8,
            'monto'=>400.00,
            'estado'=>'Activa'
            ]);
    }

    public function test_asistencia(){
        $this->visit('asistencia')
        ->type('37456789','searchText')
        ->press('Buscar')
        ->seePageIs('asistencia/mostrarAlumno?searchText=37456789') //
        ->see('Emilse Tolaba')
        ->see('Actividad')
        ->see('Fecha de vencimiento')
        ->see('Clases restantes')
        ->see('Saldo')
        ->press('')
        ->seePageIs('asistencia');
        
    }

    public function test_acceso_directo_a_agregar_alumno(){
        $this->visit('/')
        ->see('Agregar Alumno')
        ->click('Agregar Alumno')
        ->seePageIs('alumno/create');
    }

    public function test_acceso_directo_a_registrar_movimiento(){
        $this->visit('/')
        ->see('Agregar Movimiento')
        ->click('Agregar Movimiento')
        ->seePageIs('movimiento/create');
    }

    public function test_acceso_directo_a_listar_asistencia(){
        $this->visit('/')
        ->see('Listar Asistencia')
        ->click('Listar Asistencia')
        ->seePageIs('asistencia/index');
    }

    public function test_actualizar_saldo_inscripcion()
    {
        $this->visit('/alumno/inscripcion/3/mostrarInscripcion')
            ->see('Actualizar saldo')
            ->see('Nombre: Walter Benitez','nombre')
            ->see('Fecha:23-06-2019','fecha')
            ->see('N° de Inscripción: 3','inscripcion')
            ->see('Actividad: Zumba','actividad')
            ->see('Plan: 1 Clase','plan')
            ->see('Forma de pago: Contado','formadepago')
            ->see('Monto pagado: $50.00','monto')
            ->see('Saldo: $50.00','saldo')
            ->type(10,'monto_movimiento')
            ->see('Confirmar')
            ->Press('Confirmar');

            $this->seeInDatabase('inscripcion', [
                'idinscripcion'=>3,
                'monto'=>60.00,
                'saldo'=>40.00   
            ]);

            $this->seeInDatabase('movimiento_de_caja', [
                'concepto'=>'Act. Inscripción N° 3',
                'tipo'=>'Ingreso',
                'monto'=>10   
            ]);

            $this->seeInDatabase('alumno', [
                'idalumno'=>3,
                'saldo'=>40.00   
            ]);
    }

}
