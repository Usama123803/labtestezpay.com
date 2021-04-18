<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientAppointment extends Model
{
    public function patient()
    {
        return $this->belongsTo('App\Patient', 'patient_id');
    }

    /**
     * Used to create relation between location and patient
     *
     */
    public function location(){
        return $this->belongsTo('App\Location', 'locationId');
    }

    public function getAppointmentAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('m/d/Y');
    }

    public function setAppointmentAttribute($value)
    {
        $this->attributes['appointment'] = \Carbon\Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
    }

    public function state(){
        return $this->belongsTo('App\State', 'stateId');
    }

    public function country(){
        return $this->belongsTo('App\Country', 'countryId');
    }

}
