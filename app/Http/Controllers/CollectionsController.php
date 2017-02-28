<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;

class CollectionsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function collections()
    {
    	$bsit = File::where([['Course','BSIT'],['Status','Active']])->get();
    	$bsis = File::where([['Course','BSIS'],['Status','Active']])->get();
    	$bscs = File::where([['Course','BSCS'],['Status','Active']])->get();
        $category1 = File::where([['Course','BSIT'],['Status','Active']])->orderBy('thesis_date','DESC')->take(12)->get();
        $category2 = File::where([['Course','BSIS'],['Status','Active']])->orderBy('thesis_date','DESC')->take(12)->get();
        $category3 = File::where([['Course','BSCS'],['Status','Active']])->orderBy('thesis_date','DESC')->take(12)->get();
        return view('file.collections',compact(['category1','category2','category3','bsit','bsis','bscs']));   
        // return var_dump($category1->count());
    }

    public function BSIT()
    {
    	
    }

    public function BSIS()
    {
    	
    }

    public function BSCS()
    {
    	
    }
}
