<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CumpleañosTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     * @test
     */

    use DatabaseMigrations;

    public function test_listar_cumpleaños(){
        $this->visit('cumpleaños')
            ->see('Hoy es el cumpleaños de ')
            ->see('foto')
            ->see('nombre')
            ->see('edad');
    }

}
