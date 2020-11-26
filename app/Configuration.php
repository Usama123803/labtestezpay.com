<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $casts = [
        'disabled_appointment_dates' =>'json',
    ];


    public function getDisabledAppointmentDatesAttribute($value)
    {
        return array_values(json_decode($value, true) ?: []);
    }

    public function setDisabledAppointmentDatesAttribute($value)
    {
        $this->attributes['disabled_appointment_dates'] = json_encode(array_values($value));
    }

}
