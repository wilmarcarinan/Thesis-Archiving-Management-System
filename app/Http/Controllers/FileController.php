<?php

namespace App\Http\Controllers;

use App\User;
use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
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
        $files = new File;
        if($request->YEAR <> '' && $request->Adviser <> '' && $request->search <> ''){
            $files = File::where('FileTitle','like','%'.$request->search.'%')
                ->where('Status','Active')
                ->orwhere('Abstract','like','%'.$request->search.'%')
                ->orwhere('Category','like','%'.$request->search.'%')
                ->orwhere('Adviser', $request->Adviser)
                ->orwhere(DB::raw('YEAR(thesis_date)'), $request->Year)
                ->paginate(5);
        }elseif($request->YEAR <> '' && $request->Adviser == '' && $request->search == ''){
            $files = File::where('Status','Active')
                // ->orwhere(\DB::raw('YEAR(thesis_date)'), $request->Year)
                ->paginate(5);
        }elseif($request->YEAR == '' && $request->Adviser <> '' && $request->search == ''){
            $files = File::where('Status','Active')
                ->where('Adviser',$request->Adviser)
                ->paginate(5);
        }elseif($request->YEAR == '' && $request->Adviser == '' && $request->search <> ''){
            $files = File::where('Status','Active')
                ->where('FileTitle','like','%'.$request->search.'%')
                ->orwhere('Abstract','like','%'.$request->search.'%')
                ->orwhere('Category','like','%'.$request->search.'%')
                ->paginate(5);
        }
        $favorites = DB::table('favorites')->where('user_id',Auth::id())->pluck('file_id')->all();
        $bookmarks = DB::table('bookmarks')->where('user_id',Auth::id())->pluck('file_id')->all();
        

        return view('file.results',compact(['files', 'favorites', 'bookmarks']));
        // return var_dump($files);
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
            
            $favorite_list = Auth::user()->favorites()->where('Status','Active')->paginate(5);
            $bookmark_list = Auth::user()->bookmarks()->where('Status','Active')->paginate(5);
            $favorites = DB::table('favorites')->where('user_id',Auth::id())->pluck('file_id')->all();
            $bookmarks = DB::table('bookmarks')->where('user_id',Auth::id())->pluck('file_id')->all();
            return view('file.collections',compact(['favorite_list','bookmark_list','favorites','bookmarks'])); 
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
        $favorites = DB::table('favorites')->where('user_id',Auth::id())->pluck('file_id')->all();
        $bookmarks = DB::table('bookmarks')->where('user_id',Auth::id())->pluck('file_id')->all();
        return view('file.list',compact(['files','favorites','bookmarks'])); 
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
        // return Response::json(Auth::user()->favorites()->toggle($file));
    }

    public function bookmark(Request $request)
    {
        $file = File::where('id',$request->file_id)->get();
        Auth::user()->bookmarks()->toggle($file);
        return back();
    }
}
