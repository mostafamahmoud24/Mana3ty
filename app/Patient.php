<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $dates = ['created_at'];

    protected $guarded = [];

    public function diagnoses()
    {
        return $this->hasMany(\App\Diagnosis::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}
