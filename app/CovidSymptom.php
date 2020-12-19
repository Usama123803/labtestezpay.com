<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CovidSymptom extends Model
{
    /**
     * Creating unique slug at time of save
     */
    protected static function boot() {
        parent::boot();
        static::creating(function ($product) {
            $slug = Str::of($product->name)->slug('-');
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $product->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }
}
