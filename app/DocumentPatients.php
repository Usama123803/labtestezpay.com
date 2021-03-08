<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentPatients extends Model
{
    protected $fillable = ['patient_id', 'url'];

    public function patients(){
        return $this->belongsTo('App\Patient', 'patient_id');
    }

//    public function attachments()
//    {
//        return $this->hasMany(Attachment::class);
//    }

}
