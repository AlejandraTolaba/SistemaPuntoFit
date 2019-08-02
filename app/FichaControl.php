<?php

namespace sisPuntoFit;

use Illuminate\Database\Eloquent\Model;

class FichaControl extends Model
{
    protected $table='ficha_control'; 

    protected $primaryKey='idficha_control';
    
    public $timestamps=false;

    protected $fillable = [
        'idalumno',
        'peso',
        'imc',
        'edad_corporal',
        'grasa_corporal',
    	'imm',
    	'mb',
    	'grasa_viceral',
    ];
    protected $dates = [
        'fecha_registro',
    ];
}
