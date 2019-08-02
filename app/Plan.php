<?php

namespace sisPuntoFit;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table="plan";
    protected $primaryKey= 'idplan';

    public $timestamps = false;

    protected $fillable= ['nombre','cantidad_clases'];
   
}
