<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
     * Used to create relation between state and locations
     *
     */
    public function state(){
        return $this->belongsTo('App\State', 'stateId');
    }
}
