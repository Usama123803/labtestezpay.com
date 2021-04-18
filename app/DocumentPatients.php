<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentPatients extends Model
{
    protected $fillable = ['patient_id', 'url', 'type','appointment_id'];

    public function patients(){
        return $this->belongsTo('App\Patient', 'patient_id');
    }

}
