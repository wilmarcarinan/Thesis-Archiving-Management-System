<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tag;

class File extends Model
{
    // public $timestamps = false;
    protected $dates = ['thesis_date'];

    protected $fillable = [
    	'FileTitle','Abstract','SubjectArea','Category','Authors','Course','Adviser','FilePath','Status','thesis_date'
    ];

    public function tags()
    {
    	return $this->belongsToMany(Tag::class);
    }
}
