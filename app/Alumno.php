<?php

namespace sisPuntoFit;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table='alumno'; 

    protected $primaryKey='idalumno';
    
    public $timestamps=false; /* laravel pude adicionar a la tabla 2 columnas para especificar cuando ah sido creado o actualizado el registro. Si queremos que se agreguen automaticamente agregamos la propiedad timenstamps en true. En este caso no queremos que se agreguen las columnas.*/

    protected $fillable = [
    	'nombre',
    	'apellido',
        'dni',
        'fecha_nacimiento',
        'sexo',
    	'domicilio',
    	'telefono_celular',
    	'numero_contacto',
        'email',
        'certificado',
        'fecha_certificado',
        'observaciones',
        'fecha_alta date',
        'estado'
        
    ]; /* Especificamos que campos van a recibir un valor para poder almacenar el la base de datos*/

    protected $dates = [
         
        

    ];
    protected $guarded =[
    	// se van a especificar cuando no queremos que se asignen al modelo
    ];
}
