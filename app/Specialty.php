<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $fillable = ['specialty', 'description'];

    public function doctors()
    {
    	return $this->belongsToMany('App\Doctor');
    }
}
