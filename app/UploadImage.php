<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadImage extends Model
{
    protected $guarded = [];

    public function diagnosis()
    {
    	return $this->belongsTo(\App\Diagnosis::class);
    }
}
