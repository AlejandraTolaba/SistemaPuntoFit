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
            ->see(' Cumpleaños de Hoy ')
            ->seeInElement("table",'foto')
            ->seeInElement("table",'Emilse Tolaba')
            ->seeInElement("table",'21 años')
            ->see('Volver')
            ->click('Volver');
    }

}
