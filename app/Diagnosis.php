<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    protected $guarded = [];

    public function patient()
    {
    	return $this->belongsTo(\App\Patient::class);
    }

    public function user()
    {
    	return $this->belongsTo(\App\User::class);
    }

    public function images()
    {
        return $this->hasMany(\App\UploadImage::class);
    }
}
