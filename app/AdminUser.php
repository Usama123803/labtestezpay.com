<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    /**
     * Used to create relation between location and patient
     *
     */
    public function location(){
        return $this->belongsTo('App\Location', 'locationId');
    }
}
