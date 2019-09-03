<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductoTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     * @test
     */

    use DatabaseMigrations;


    public function test_agregar_producto()
    {
        $this->visit('producto/create')
        ->see('Nuevo Producto')
        ->see(1)
        ->type('Barrita de cereal' ,'nombre')
        ->type(20,'stock')
        ->type(50.5,'precio')
        ->see('Guardar')
        ->see('Cancelar')
        ->press('Guardar');
    $this->seeInDatabase('producto', [
        'nombre'=>'Barrita de cereal',
        'stock'=>20,
        'precio'=>50.5,
        ]);
    }

    public function test_listar_productos(){
        $this->visit('producto')
            ->see('Listado de Productos')
            ->see('Código')
            ->see('Nombre')
            ->see('Precio')
            ->see('Stock')
            ->seeInElement('.text-danger', 0)
            ->dontSeeInElement('.text-info', 20)
            ->seeInElement('.text-info', 9)
            ->dontSeeInElement('.text-info', 100);
    }

    public function test_modificar_datos_de_un_producto()
    {
        $this->visit('producto/2/edit')
            ->see('Editar Producto')
            ->see(2)
            ->see('Barra de cereal')
            ->type(31.4,'precio')
            ->type(81,'stock')
            ->see('Confirmar')
            ->see('Cancelar')
            ->press('Confirmar')
            ->seePageIs('producto');
            $this->seeInDatabase('producto', [
                'stock' => 81,
                'precio' => 31.4,
                ]);
    }

    public function test_eliminar_producto()
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
