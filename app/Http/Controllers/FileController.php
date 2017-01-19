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
        // if($request->keyword == null)
        // {
        //     return back();
        // }

        $this->validate(request(),[
            'keyword' => 'required'
        ]);

        $files = File::where('FileTitle','like','%'.$request->keyword.'%')
                ->orwhere('FileDescription','like','%'.$request->keyword.'%')
                ->get();

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
            'FilePath' => 'min:1|max:2000|required'
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
