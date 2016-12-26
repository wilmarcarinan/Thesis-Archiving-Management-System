<?php

namespace App\Http\Controllers;

use App\User;
use App\File;
use Illuminate\Http\Request;

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
        if($request->keyword == null)
        {
            $files = File::get();
        }

        $files = File::where('FileTitle','like','%'.$request->keyword.'%')->get();//->and('FileDescription','like','%'.$request->keyword.'%')

        return view('file.search',compact('files'));
        // return $filesfile.;
    }

    public function FileForm()
    {
    	return view('file.addfile');
    }

    public function AddFile(Request $request)
    {
        $this->validate(request(),[
            'FileTitle' => 'required',
            'FileDescription' => 'required',
            'FilePath' => 'required'
        ]);
        
        $file = new File;

        $fileObj = $request->file('FilePath');
        $fileName = $fileObj->getClientOriginalName();
        $fileObj->storeAs('files',$fileName);
        
        $file->FileTitle = $request->FileTitle;
        $file->FileDescription = $request->FileDescription;
        $file->FilePath = '/files/'.$fileName;
        $file->save();

        return redirect('search');
        // return $fileName;
    }
}
