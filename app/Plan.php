<?php

namespace sisPuntoFit;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table="plan";
    protected $fillable= ['nombre','estado'];

    public function actividades(){
    	return $this->belongsToMany('sisPuntoFit\Actividad')->withTimestamps();

    }

    public function scopeSearchPlan($query,$nombre){
		return $query->where('nombre','=',$nombre);

	}

	public function scopeSearchEventP($query,$nombre){
		
		return $query->where('nombre','LIKE',"%".$nombre."%");

	}
}
