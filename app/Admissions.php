<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admissions extends Model
{
    protected $fillable = [
      'user_id', 'admission_types_id', 'date', 'working_hours_id', 'status'
    ];

    public function admission_type() {
        return $this->belongsTo('App\AdmissionTypes');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
