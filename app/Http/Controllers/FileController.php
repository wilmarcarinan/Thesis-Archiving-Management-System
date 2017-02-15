<?php

namespace App\Http\Controllers;

use App\User;
use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Chumper\Zipper\Facades\Zipper;
use Carbon\Carbon;
use App\Log;
use Illuminate\Validation\Rule;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search()
    {
        $advisers = File::distinct()->where('Status','Active')->get(['Adviser']);
        $years = File::distinct()->where('Status','Active')->get([DB::raw('YEAR(thesis_date)')]);
        return view('file.search',compact(['advisers', 'years']));
        // return var_dump($years);
    }

    public function SearchResults(Request $request)
    {
        $files = new File;
        if($request->Year <> '' && $request->Adviser <> '' && $request->search <> ''){
            $files = File::where('FileTitle','like','%'.$request->search.'%')
                ->where('Status','Active')
                ->orwhere('Abstract','like','%'.$request->search.'%')
                ->orwhere('Category','like','%'.$request->search.'%')
                ->orwhere('Adviser', $request->Adviser)
                ->orwhere(DB::raw('YEAR(thesis_date)'), $request->Year)
                ->paginate(5);
        }elseif($request->Year <> '' && $request->Adviser == '' && $request->search == ''){
            $files = File::where('Status','Active')
                ->where(DB::raw('YEAR(thesis_date)'), $request->Year)
                ->paginate(5);
        }elseif($request->Year == '' && $request->Adviser <> '' && $request->search == ''){
            $files = File::where('Status','Active')
                ->where('Adviser',$request->Adviser)
                ->paginate(5);
        }elseif($request->Year == '' && $request->Adviser == '' && $request->search <> ''){
            $files = File::where('Status','Active')
                ->where('FileTitle','like','%'.$request->search.'%')
                ->orwhere('Abstract','like','%'.$request->search.'%')
                ->orwhere('Category','like','%'.$request->search.'%')
                ->paginate(5);
        }elseif($request->Year <> '' && $request->Adviser <> '' && $request->search == ''){
            $files = File::where('Status','Active')
                ->where([
                    [DB::raw('YEAR(thesis_date)'), $request->Year],
                    ['Adviser', $request->Adviser],
                ])
                ->paginate(5);
        }elseif($request->Year <> '' && $request->Adviser == '' && $request->search <> ''){
            $files = File::where([
                    ['Status','Active'],
                    [DB::raw('YEAR(thesis_date)'), $request->Year],
                    ['FileTitle','like','%'.$request->search.'%'],
                ])
                ->orwhere('Abstract','like','%'.$request->search.'%')
                ->orwhere('Category','like','%'.$request->search.'%')
                ->paginate(5);
        }elseif($request->Year == '' && $request->Adviser <> '' && $request->search <> ''){
            $files = File::where([
                ['Status','Active'],
                ['FileTitle','like','%'.$request->search.'%'],
                ['Adviser', $request->Adviser],
                ])
                ->orwhere('Abstract','like','%'.$request->search.'%')
                ->orwhere('Category','like','%'.$request->search.'%')
                ->paginate(5);
            // return 'Search and Adviser has a value of '.$request->search.' and '.$request->Adviser;
        }
        $favorites = DB::table('favorites')->where('user_id',Auth::id())->pluck('file_id')->all();
        $bookmarks = DB::table('bookmarks')->where('user_id',Auth::id())->pluck('file_id')->all();
        
        if($request->Year <> '' || $request->Adviser <> '' || $request->search <> ''){
            $log = new Log;
            $log->Subject = 'Search';
            
            if($request->Year <> '' && $request->Adviser <> '' && $request->search <> ''){
                $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has searched the terms ".$request->search.", ".$request->Adviser." and ".$request->Year;
            }elseif($request->Year <> '' && $request->Adviser == '' && $request->search == ''){
                $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has searched the term ".$request->Year;
            }elseif($request->Year == '' && $request->Adviser <> '' && $request->search == ''){
                $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has searched the term ".$request->Adviser;
            }elseif($request->Year == '' && $request->Adviser == '' && $request->search <> ''){
                $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has searched the term ".$request->search;
            }elseif($request->Year <> '' && $request->Adviser <> '' && $request->search == ''){
                $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has searched the terms ".$request->Year." and ".$request->Adviser;
            }elseif($request->Year <> '' && $request->Adviser == '' && $request->search <> ''){
                $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has searched the terms ".$request->search." and ".$request->Year;
            }elseif($request->Year == '' && $request->Adviser <> '' && $request->search <> ''){
                $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has searched the terms ".$request->search." and ".$request->Adviser;
            }
            $log->student_id = Auth::id();
            $log->save();
        }

        return view('file.results',compact(['files', 'favorites', 'bookmarks']));
        // return var_dump($files);
    }

    public function FileForm()
    {
        $courses = File::distinct()->where('Status','Active')->get(['Course']);
    	return view('file.addfile',compact('courses'));
    }

    public function AddFile(Request $request)
    {
        $this->validate(request(),[
            'FileTitle' => [
                'required',
                Rule::unique('files')->ignore(auth()->id())
            ],
            'Category' => 'required',
            'Abstract' => 'required',
            'Authors' => 'required',
            'Course' => 'required',
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
        $file->Course = $request->Course;
        $file->Adviser = $request->Adviser;
        $file->thesis_date = $request->thesis_date;
        $file->FilePath = $fileName;
        $file->save();

        $log = new Log;
        $log->Subject = 'File Upload';
        $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has added a file entitled ".$request->FileTitle;
        $log->student_id = Auth::id();
        $log->save();

        return redirect('search');
        // return $fileName;
    }

    public function collections()
    {
        $category1 = File::where('Course','BSIT')->orderByRaw('RAND()')->take(12)->get();
        $category2 = File::where('Course','BSIS')->orderByRaw('RAND()')->take(12)->get();
        $category3 = File::where('Course','BSCS')->orderByRaw('RAND()')->take(12)->get();
        $filtered = $category1->filter(function ($value, $key) {
            return $value->count() > 2;
        });

        $filtered->all();
        return view('file.collections',compact(['category1','category2','category3']));   
        // return var_dump($category1->count());
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
        $file = File::select('FileTitle')->where('id',$request->file_id)->get();
        $log = new Log;
        $log->Subject = 'File Locking';
        $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has locked ".$file[0]['FileTitle'];
        $log->student_id = Auth::id();
        $log->save();
        
        return back();
        // return $file_title;
    }

    public function unlock(Request $request)
    {
        File::where('id',$request->file_id)
            ->update(['Status'=>'Active']);
        
        $file = File::select('FileTitle')->where('id',$request->file_id)->get();
        $log = new Log;
        $log->Subject = 'File Locking';
        $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has unlocked ".$file[0]['FileTitle'];
        $log->student_id = Auth::id();
        $log->save();

        return back();
    }

    public function increment_views(Request $request)
    {
        $file = File::select('id','FileTitle')->where('id',$request->file_id)->get();
        Auth::user()->recent_views()->attach($file);

        $log = new Log;
        $log->Subject = 'Views';
        $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has viewed a thesis entitled ".$file[0]['FileTitle'];
        $log->student_id = Auth::id();
        $log->save();
    }

    public function favorite(Request $request)
    {
        $file = File::where('id',$request->file_id)->get();
        $file = Auth::user()->favorites()->toggle($file);
    }

    public function bookmark(Request $request)
    {
        $file = File::where('id',$request->file_id)->get();
        $file = Auth::user()->bookmarks()->toggle($file);
        // echo $request->file_id;
    }

    public function compress(Request $request)
    {   
        $name = $request->filename;
        $date = $request->filedate;
        $files = File::where(DB::raw('YEAR(thesis_date)'),$date)->get();
        Zipper::make(storage_path('app/'.$name.'.zip'));
        foreach($files as $file){
            Zipper::add(array(
                    'files/'.$file->FilePath
                ));
        }
        Zipper::close();
        return Response::download(storage_path('app/'.$name.'.zip'))->deleteFileAfterSend(true);
    }

    public function generate_temp(Request $request)
    {
        $fileWebLink = $request->name;
        $htmlString = "
            <body oncontextmenu='return false;' ondragstart='return false' onselectstart='return false' style='margin:0px; border:0px; padding:0px; overflow:hidden'>
                <iframe src='$fileWebLink' style='margin:0px; border:0px; padding:0px; height:100%; width:100% '></iframe>
            </body>";
        return $htmlString;
    }

    public function encrypted_data($data)
    {
        $decrypted_data = decrypt($data);
        return Response::json($decrypted_data);
    }

    // public function comp(Request $request)
    // {
    //     $files = new File;
    //     $request->Year <> '' && $request->Adviser == '' && $request->search == ''){
    //     $files = File::where('Status','Active')->where(DB::raw('YEAR(thesis_date)'), $request->Year)
    // }
}
