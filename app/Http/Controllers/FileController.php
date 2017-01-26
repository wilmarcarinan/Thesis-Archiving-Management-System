<?php

namespace App\Http\Controllers;

use App\User;
use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search()
    {
        $files = File::get();
        return view('file.search',compact('files'));
    }

    public function SearchResults(Request $request)
    {
        $this->validate(request(),[
            'search' => 'required'
        ]);

        $files = File::where('FileTitle','like','%'.$request->search.'%')
                ->orwhere('Abstract','like','%'.$request->search.'%')
                ->get();

        return view('file.search',compact(['files']));
    }

    public function FileForm()
    {
    	return view('file.addfile');
    }

    public function AddFile(Request $request)
    {
        $this->validate(request(),[
            'FileTitle' => 'required',
            'Category' => 'required',
            'Abstract' => 'required',
            'Authors' => 'required',
            'Adviser' => 'required',
            'ThesisDate' => 'required',
            'FilePath' => 'min:1|max:2000|required'
        ]);
        
        $file = new File;

        $fileObj = $request->file('FilePath');
        $fileName = $fileObj->getClientOriginalName();
        $fileObj->storeAs('files',$fileName);
        
        $file->FileTitle = $request->FileTitle;
        $file->Category = $request->Category;
        $file->Abstract = $request->Abstract;
        $file->Authors = $request->Authors;
        $file->Adviser = $request->Adviser;
        $file->created_at = $request->ThesisDate;
        $file->FilePath = '/files/'.$fileName;
        $file->save();

        return redirect('search');
        // return $fileName;
    }

    public function collections()
    {
        if(Auth::User()->Role == 'User'){
            return view('file.collections');    
        }
        else{
            return back();
        }
        
    }

    public function list()
    {
        $files = File::get();
        if(Auth::User()->Role == 'User'){
            return view('file.list',compact('files'));    
        }
        else{
            return back();
        }
    }
}
