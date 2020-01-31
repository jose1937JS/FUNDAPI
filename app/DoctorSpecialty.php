<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DoctorSpecialty extends Pivot
{
    protected $fillable = ['doctor_id', 'specialty_id'];

}
