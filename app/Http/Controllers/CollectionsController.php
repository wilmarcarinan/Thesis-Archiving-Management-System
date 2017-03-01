<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\File;
use App\Note;
use DB;

class CollectionsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function collections()
    {
        if(!Auth::user()->is_admin()){
            $courses = File::where('Status','Active')->get();
            // $bsis = File::where([['Course','BSIS'],['Status','Active']])->get();
            // $bscs = File::where([['Course','BSCS'],['Status','Active']])->get();
            $category1 = File::where([['Course','BSIT'],['Status','Active']])->orderBy('thesis_date','DESC')->take(12)->get();
            $category2 = File::where([['Course','BSIS'],['Status','Active']])->orderBy('thesis_date','DESC')->take(12)->get();
            $category3 = File::where([['Course','BSCS'],['Status','Active']])->orderBy('thesis_date','DESC')->take(12)->get();
            return view('file.collections',compact(['category1','category2','category3','courses']));   
            // return var_dump($category1->count());
        }else{
            return redirect()->action('HomeController@index');
        }
    }

    public function Course($Course)
    {
        if(!Auth::user()->is_admin()){
            $files = File::where([['Status','Active'],['Course',$Course]])->get();
            $favorites = DB::table('favorites')->where('user_id',Auth::id())->pluck('file_id')->all();
            $bookmarks = DB::table('bookmarks')->where('user_id',Auth::id())->pluck('file_id')->all();
            $notes = Note::where('user_id',Auth::id())->get();
            $notes_FileID = Note::where('user_id',Auth::id())->pluck('file_id')->all();
            $notes_note = Note::where('user_id',Auth::id())->pluck('note')->all();
            return view('collections.course',compact(['files','favorites','bookmarks','notes','notes_FileID','notes_note','Course']));
        }else{
            return redirect()->action('HomeController@index');
        }
    }
}
