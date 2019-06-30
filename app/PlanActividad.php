<?php

namespace sisPuntoFit;

use Illuminate\Database\Eloquent\Model;

class PlanActividad extends Model
{
    protected $table="plan_actividad";

    protected $fillable= ['idactividad','idplan','precio'];
}
