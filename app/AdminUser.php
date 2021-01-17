<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    /**
     * Used to create relation between location and patient
     *
     */
//    public function location(){
//        return $this->belongsTo('App\Location', 'locationId');
//    }

    /**
     * Used to create relation between option and course
     *
     */
    public function locations(){
        return $this->belongsToMany('App\Location','users_locations', 'user_id', 'location_id');
    }

}
