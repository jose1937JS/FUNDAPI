<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
	protected $fillable = ['name', 'address', 'description', 'manager', 'rif', 'mission', 'vision'];


	public function enterprise_emails()
	{
		return $this->hasMany('App\EnterpriseEmail');
	}

	public function enterprise_phones()
	{
		return $this->hasMany('App\EnterprisePhone');
	}

	public function lastid()
	{
		return $this->max('id');
	}
}
