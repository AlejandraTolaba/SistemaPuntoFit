<?php

namespace sisPuntoFit;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $table='profesor'; 

    protected $primaryKey='idprofesor';
    
    public $timestamps=false;

    protected $fillable = [
    	'nombre',
        'apellido',
        'foto',
        'dni',
        'sexo',
    	'domicilio',
    	'telefono_celular',
    	'numero_contacto',
        'email',
        'estado'
        
    ];

    protected $dates = [ 
        'fecha_nacimiento',
        'fecha_alta'
    ];
}
