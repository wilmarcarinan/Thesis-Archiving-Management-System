<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public $timestamps = false;
	// // ...
 //    // boot
 //    static::creating( function ($model) {
 //        $model->setCreatedAt($model->freshTimestamp());
 //    });
}
