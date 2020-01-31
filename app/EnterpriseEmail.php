<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnterpriseEmail extends Model
{
    protected $fillable = ['email', 'enterprise_id'];
}
