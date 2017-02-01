<?php

namespace App\Http\Controllers;

use App\User;
use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search()
    {
        $advisers = File::distinct()->where('Status','Active')->get(['Adviser']);
        $years = File::distinct()->where('Status','Active')->get([\DB::raw('YEAR(thesis_date)')]);
        return view('file.search',compact(['advisers', 'years']));
        // return var_dump($years);
    }

    public function SearchResults(Request $request)
    {
        // $this->validate(request(),[
        //     'search' => 'required'
        // ]);

        $files = File::where('FileTitle','like','%'.$request->search.'%')
                ->where('Status','Active')
                ->orwhere('Abstract','like','%'.$request->search.'%')
                ->orwhere('Category','like','%'.$request->search.'%')
                ->orwhere('Adviser', $request->Adviser)
                ->orwhere(\DB::raw('YEAR(thesis_date)'), $request->Year)
                ->paginate(5);

        return view('file.results',compact('files'));
        // return var_dump($request->search);
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
            // 'Adviser' => 'required',
            'thesis_date' => 'required',
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
        $file->thesis_date = $request->thesis_date;
        $file->FilePath = '/files/'.$fileName;
        $file->save();

        return redirect('search');
        // return $fileName;
    }

    public function collections()
    {
        if(Auth::User()->Role == 'User'){
            
            $files = Auth::user()->favorites;
            return view('file.collections',compact('files')); 
            // return var_dump($files);
        }
        else{
            return back();
        }
        
    }

    public function list()
    {
        $files = File::where('Status','Active')
                ->paginate(5);
        return view('file.list',compact('files'));    
    }

    public function lock(Request $request)
    {
        File::where('id',$request->file_id)
            ->update(['Status'=>'Inactive']);
        
        return back();
    }

    public function unlock(Request $request)
    {
        File::where('id',$request->file_id)
            ->update(['Status'=>'Active']);
        
        return back();
    }

    public function increment_views(Request $request)
    {
        return 'hello';
    }

    public function favorite(Request $request)
    {
        $file = File::where('id',$request->file_id)->get();
        Auth::user()->favorites()->toggle($file);
        return back();
    }

    public function removeFavorite(Request $request)
    {
        $file = File::where('id',$request->file_id)->get();
        Auth::user()->favorites()->toggle($file);
        return back();
    }

    public function bookmark(Request $request)
    {
        $file = File::where('id',$request->file_id)->get();
        Auth::user()->bookmarks()->toggle($file);
        return back();
    }

    public function removeBookmark(Request $request)
    {
        $file = File::where('id',$request->file_id)->get();
        Auth::user()->bookmarks()->toggle($file);
        return back();
    }
}
