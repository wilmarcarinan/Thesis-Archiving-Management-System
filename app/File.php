<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    // public $timestamps = false;
    protected $dates = ['thesis_date'];

    protected $fillable = [
    	'FileTitle','Abstract','Category','Authors','Course','Adviser','FilePath','Status','thesis_date'
    ];
}
