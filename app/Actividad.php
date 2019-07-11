<?php

namespace sisPuntoFit;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividad';

    protected $primaryKey = 'idactividad';

    public $timestamps=false;

    protected $fillable = [
        'nombre',
        'estado'
    ];

    protected $guarded = [

    ];

    public function plan(){
        return $this->belongsToMany('sisPuntoFit\Plan') ;
    }
}
