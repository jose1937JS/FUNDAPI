<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
	protected $fillable = ['name', 'amount', 'description'];

	public function doctors()
	{
		return $this->belongsToMany('App\Doctor');
	}

	function lastid()
	{
		return $this->max('id');
	}
}
