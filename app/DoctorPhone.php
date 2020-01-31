<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorPhone extends Model
{
	protected $fillable = ['phone', 'doctor_id'];
}
