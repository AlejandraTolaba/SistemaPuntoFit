<?php

namespace sisPuntoFit;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table='alumno'; 

    protected $primaryKey='idalumno';
    
    public $timestamps=false;

    protected $fillable = [
    	'nombre',
    	'apellido',
        'dni',
        'sexo',
    	'domicilio',
    	'telefono_celular',
    	'numero_contacto',
        'email',
        'certificado',
        'observaciones',
        'estado',
        'saldo',
        'foto',
        'rutina'
        
    ];

    protected $dates = [
        
        'fecha_nacimiento',
        'fecha_certificado', 
        'fecha_alta'
    ];
    protected $guarded =[
    	// se van a especificar cuando no queremos que se asignen al modelo
    ];
}
