<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentPatients extends Model
{
    protected $fillable = ['patient_id', 'url'];
}
