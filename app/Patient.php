<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use softDeletes;

//    protected $fillable = ['first_name', 'last_name', 'email', 'phone_number', 'message'];

    /**
     * Used to create relation between country and patient
     *
     */
    public function country(){
        return $this->belongsTo('App\Country', 'countryId');
    }

    /**
     * Used to create relation between location and patient
     *
     */
    public function location(){
        return $this->belongsTo('App\Location', 'locationId');
    }

    /**
     * Used to create relation between state and patient
     *
     */
    public function state(){
        return $this->belongsTo('App\State', 'stateId');
    }

    public function getDobAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('m/d/Y');
    }

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = \Carbon\Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
    }

    public function getAppointmentAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('m/d/Y');
    }

    public function setAppointmentAttribute($value)
    {
        $this->attributes['appointment'] = \Carbon\Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
    }

}
