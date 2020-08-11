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

}
