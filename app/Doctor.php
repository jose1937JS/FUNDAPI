<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
	protected $fillable = ['dni', 'name', 'lastname', 'schedule'];

	public function specialties()
	{
		return $this->belongsToMany('App\Specialty');
	}

	public function doctor_phones()
	{
		return $this->hasMany('App\DoctorPhone');
	}

	public function services()
	{
		return $this->belongsToMany('App\Service');
	}

	function lastid()
	{
		return $this->max('id');
	}
}
