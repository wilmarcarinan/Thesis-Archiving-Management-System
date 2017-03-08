<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\File;

class Tag extends Model
{
    public function files()
    {
    	return $this->belongsToMany(File::class);
    }
}
