<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmissionTypes extends Model
{
    protected $fillable = [
        'name', 'description', 'status'
    ];
}
