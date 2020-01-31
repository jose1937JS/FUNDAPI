<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DoctorService extends Pivot
{
    protected $fillable = ['doctor_id', 'service_id'];
}
