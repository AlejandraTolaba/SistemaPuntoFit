<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use sisPuntoFit\Actividad;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class PaginarTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_paginar_actividades()
    {

        $first = factory(Actividad::class)->create([
            'nombre'=>'Actividad mas antigua'
        ]);
        
        factory(Actividad::class)->times(10)->create();
        
        $last = factory(Actividad::class)->create([
            'nombre' => 'Actividad mas reciente'
        ]);

        $this->visit(route('actividad.index'))
             ->seeInElement("table",$last->nombre)
             ->dontSeeInElement("table",$first->nombre)
             ->select('2','paginate')
             ->seeInElement("table",$first->nombre)
             ->dontSeeInElement("table",$last->nombre);
            
    }
}
