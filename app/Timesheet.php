<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    public function adminUser()
    {
        return $this->belongsTo('App\AdminUser', 'user_id');
    }
}
