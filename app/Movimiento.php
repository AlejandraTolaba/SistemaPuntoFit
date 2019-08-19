<?php

namespace sisPuntoFit;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $table="movimiento_de_caja";

    protected $primaryKey="idmovimientodecaja";

    public $timestamps=false;

    protected $fillable= [
        'concepto',
        'tipo',
        'monto',
        'idforma_de_pago'
    ];

    protected $dates = [
        'fecha'
    ];
}
