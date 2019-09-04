<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsuarioTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use DatabaseMigrations;
    public function test_agregar_usuario()
    {
        $this->visit('usuarios/create')
        ->see('Nuevo Usuario')
        ->type('Isabel' ,'name')
        ->type('isabel@gmail.com' ,'email')
        ->type('1234','password')
        ->select('ADMINISTRADOR','tipoUsuario')
        ->see('Guardar')
        ->see('Cancelar')
        ->press('Guardar');
    $this->seeInDatabase('users', [
        'name'=>'Isabel',
        'email'=>'isabel@gmail.com',
        'tipo'=>'ADMINISTRADOR'
        ]);
    }

    public function test_listar_usuarios(){
        $this->visit('usuarios')
            ->see('Listado de Usuarios')
            ->see('Nombre')
            ->see('E-Mail')
            ->see('tipo')
            ->seeInElement('table', 'Isabel');
    }

    public function test_modificar_contraseña()
    {
    }

    public function test_eliminar_usuario()
    {
        $this->visit('producto')
        ->see('8')
        ->see('Agua')
        ->click('Eliminar-8')
        ->see('Eliminar Producto')
        ->see('Confirme si desea eliminar el producto')
        ->press('Confirmar-8');
        $this->dontSeeInDatabase('producto', ['nombre' => 'Agua']);
    }
}
