<?php

namespace sisPuntoFit;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table="inscripcion";

    protected $primaryKey='idinscripcion';

    public $timestamps = false;

    protected $fillable= [
        'idalumno',
        'idactividad',
        'idforma_de_pago',
        'cantidad_clases',
        'monto',
        'saldo',
        'estado'
        
    ];
        
    protected $dates = ['fecha_vencimiento_inscripcion','fecha_inscripcion'];
}