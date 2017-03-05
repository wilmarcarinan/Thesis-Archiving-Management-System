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
use App\Note;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

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
        $favorites = DB::table('favorites')->where('user_id',Auth::id())->pluck('file_id')->all();
        $bookmarks = DB::table('bookmarks')->where('user_id',Auth::id())->pluck('file_id')->all();
        $notes = Note::where('user_id',Auth::id())->get();
        $notes_FileID = Note::where('user_id',Auth::id())->pluck('file_id')->all();
        $notes_note = Note::where('user_id',Auth::id())->pluck('note')->all();
        // $requests = $request->all();
        if(empty($request->search)){
            return back()->with('status','Sorry! You didn\'t input any keywords');
        }
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
        }else
        
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

        return view('file.results',compact(['files', 'bookmarks','requests', 'favorites','notes','notes_FileID','notes_note']));
        // return $requests;
    }

    public function FileForm()
    {
        if(Auth::user()->is_admin() || Auth::user()->Role == 'Encoder'){
            $courses = File::distinct()->where('Status','Active')->get(['Course']);
            return view('file.addfile',compact('courses'));
        }else{
            return redirect()->action('HomeController@index');
        }
    }

    public function AddFile(Request $request)
    {
        // return $request->all();
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
            'FilePath' => 'min:1|required|mimes:pdf'
        ]);
        
        $file = new File;

        $fileObj = $request->file('FilePath');
        $fileName = $fileObj->getClientOriginalName();
        // $fileObj->storeAs('files',$fileName);
        $path = Storage::putFileAs(
            'files', $fileObj, $fileName
        );
        
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

        return back()->with('status','Upload File Success');
        // return $fileName;
    }

    public function list()
    {
        $files = File::where('Status','Active')->get();
        $favorites = DB::table('favorites')->where('user_id',Auth::id())->pluck('file_id')->all();
        $bookmarks = DB::table('bookmarks')->where('user_id',Auth::id())->pluck('file_id')->all();
        $years = File::distinct()->where('Status','Active')->get([DB::raw('YEAR(thesis_date)')]);
        $notes = Note::where('user_id',Auth::id())->get();
        $notes_FileID = Note::where('user_id',Auth::id())->pluck('file_id')->all();
        $notes_note = Note::where('user_id',Auth::id())->pluck('note')->all();
        return view('file.list',compact(['files','favorites','bookmarks','years','notes','notes_FileID','notes_note'])); 
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
        if($request->fidder){
            $file = File::select('id','FileTitle', 'FilePath')->where([['id',$request->fidder],['Status','Active']])->get();
            Auth::user()->recent_views()->attach($file);
            unlink('files/'.Auth::id().$file[0]['FilePath']);
        }else{
            // exec("echo rm files/".Auth::id().$file[0]['FilePath']."|at now +20 seconds");
            // sleep(10);//timeout to make sure does not STAY
            // unlink('files/'.$file[0]['FilePath'].$file[0]['id']);

            // return $file[0]['FilePath'];
            //redirect(url()."pdf.js/web/viewer.html?fidder=".$request->file_id."file=".url()."/files".$file[0]['FilePath']);
        }
    }

    public function favorite(Request $request)
    {
        $get_file = File::where('id',$request->file_id)->get();
        $file = Auth::user()->favorites()->toggle($get_file);
        // return $get_file[0]->FileTitle;
        $log = new Log;
        if(empty($file['attached'][0])){
            $log->Subject = 'Unfavorite';
            $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has Unfavorited ".$get_file[0]->FileTitle;
            $log->student_id = Auth::id();
            $log->save();
            return 'Detached';
        }else{
            $log->Subject = 'Favorite';
            $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has Favorited ".$get_file[0]->FileTitle;
            $log->student_id = Auth::id();
            $log->save();
            return 'Attached';
        }
    }

    public function bookmark(Request $request)
    {
        $get_file = File::where('id',$request->file_id)->get();
        $file = Auth::user()->bookmarks()->toggle($get_file);
        $log = new Log;
        if(empty($file['attached'][0])){
            $log->Subject = 'Unbookmark';
            $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has Unbookmarked ".$get_file[0]->FileTitle;
            $log->student_id = Auth::id();
            $log->save();
            return 'Detached';
        }else{
            $log->Subject = 'Bookmark';
            $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has Bookmarked ".$get_file[0]->FileTitle;
            $log->student_id = Auth::id();
            $log->save();
            return 'Attached';
        }
    }

    public function compress(Request $request)
    {   
        if($request->filename <> '' && $request->filename <> ''){
            $name = $request->filename;
            $date = $request->filedate;
            $files = File::where(DB::raw('YEAR(thesis_date)'),$date)->get();
            Zipper::make(storage_path('app/'.$name.'.zip'));
            foreach($files as $file){
                Zipper::add(array(
                        storage_path('app/public/files/').$file->FilePath
                    ));
            }
            Zipper::close();
            
            $log = new Log;
            $log->Subject = 'File Archived';
            $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has downloaded files from year ".$date." with the name ".$name;
            $log->student_id = Auth::id();
            $log->save();
            $headers = array(
                'Content-Type' => 'application/octet-stream',
                'Content-Disposition' => 'attachment; filename='.$name.'.zip',
                'Connection' => 'close'
            );
            $response = Response::download(storage_path('app/'.$name.'.zip'),$name.'.zip',$headers)->deleteFileAfterSend(true);    
            ob_end_clean();
            return $response;
        }
        elseif($request->has('backup')){
            $files = File::all();
            Zipper::make(storage_path('app/'.Carbon::now()->toDateString().'.zip'));
            foreach($files as $file){
                Zipper::add(array(
                        storage_path('app/public/files/').$file->FilePath
                    ));
            }
            Zipper::close();

            $log = new Log;
            $log->Subject = 'File Backup';
            $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has backed up the all Thesis Files.";
            $log->student_id = Auth::id();
            $log->save();

            $headers = array(
                'Content-Type' => 'application/octet-stream',
                'Content-Disposition' => 'attachment; filename='.Carbon::now()->toDateString().'.zip',
                'Connection' => 'close'
            );
            $response = Response::download(storage_path('app/'.Carbon::now()->toDateString().'.zip',Carbon::now()->toDateString().'.zip',$headers))->deleteFileAfterSend(true);
            ob_end_clean();
            return $response;
        }
        else{
            return back();
        }
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

    public function View_PDF(Request $request)
    {
        if(Auth::check()){
            $file = File::select('id','FileTitle', 'FilePath')->where([['id',$request->fidder],['Status','Active']])->get();
            copy(storage_path('app/public/files/'.$file[0]['FilePath']), 'files/'.Auth::id().$file[0]['FilePath']);

            $log = new Log;
            $log->Subject = 'Views';
            $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has viewed a thesis entitled ".$file[0]['FileTitle'];
            $log->student_id = Auth::id();
            $log->save();
        }
    }

    public function updateFile()
    {
        // return request()->all();

        $this->validate(request(),[
            'title' => 'required',
            'abstract' => 'required',
            'categories' => 'required',
            'authors' => 'required',
            'course' => 'required',
            'thesis_date' => 'required'
        ]);

        $file = File::find(request()->id);

        $file->update([
            'FileTitle' => request()->title,
            'Abstract' => request()->abstract,
            'Category' => request()->categories,
            'Authors' => request()->authors,
            'Course' => request()->course,
            'Adviser' => request()->adviser,
            'thesis_date' => request()->thesis_date
        ]);

        $log = new Log;
        $log->Subject = 'File Update';
        $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has updated a thesis entitled ".$file->FileTitle;
        $log->student_id = Auth::id();
        $log->save();

        return request()->all();
    }

    public function addNotes()
    {
        // return request()->all();
        if(request()->note <> ''){
            $this->validate(request(),[
                'note' => 'required'
            ]);

            $note = new Note;
            $note->note = request()->note;
            $note->file_id = request()->file_id;
            $note->user_id = Auth::id();
            $note->save();

            $file = File::find(request()->file_id);

            $log = new Log;
            $log->Subject = 'Add Note';
            $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has added a note in a Thesis entitled ".$file->FileTitle;
            $log->student_id = Auth::id();
            $log->save();

            return $note;
        }else{
            return 'error';
        }

        // return $note;
    }

    public function editNotes()
    {
        // return request()->all();
        $note = Note::find(request()->id);
        if(request()->note == $note->note){
            return 'Nothing Changed!';
        }
        if(request()->note <> '' ){
            $note->update([
                'note' => request()->note
            ]);

            $file = File::find(request()->file_id);

            $log = new Log;
            $log->Subject = 'Edit Note';
            $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has updated his/her note in a Thesis entitled ".$file->FileTitle;
            $log->student_id = Auth::id();
            $log->save();

            return $note;
        }else{
            return 'Unable to update!';
        }
    }

    public function deleteNotes()
    {
        // return request()->all();
        $note = Note::find(request()->id);
        $note->delete();
        // return $note;
        return request()->all();
        // return 'Success Deletion of Note';
    }
}
