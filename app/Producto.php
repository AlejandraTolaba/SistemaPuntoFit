<?php

namespace sisPuntoFit;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table='producto'; 

    protected $primaryKey='idproducto';
    
    public $timestamps=false;

    protected $fillable = [
    	'nombre',
        'stock',
        'precio'
    ];
}
