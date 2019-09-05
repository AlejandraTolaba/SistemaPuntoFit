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
    use DatabaseTransactions;

    public function test_listar_usuarios(){
        $this->visit('usuarios')
            ->see('Listado de Usuarios')
            ->see('Nombre')
            ->see('E-Mail')
            ->see('tipo')
            ->seeInElement('table', 'Mirian Aldana Quispe');
    }


    public function test_eliminar_usuario()
    {
        $this->visit('usuarios')
        ->click('Eliminar-3')
        ->see('Eliminar Usuario')
        ->see('Confirme si desea eliminar el usuario')
        ->press('Confirmar-3');
        $this->dontSeeInDatabase('users', ['id' => 3]);
    }
}
