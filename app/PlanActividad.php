<?php

namespace sisPuntoFit;

use Illuminate\Database\Eloquent\Model;

class PlanActividad extends Model
{
    protected $table="plan_actividad";

    public $timestamps = false;

    protected $fillable= ['idactividad','idplan','precio'];
}
