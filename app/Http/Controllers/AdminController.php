<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Log;
use App\User;
use App\File;
use DB;
use Charts;

class AdminController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function showLogs()
    {
        if(Auth::user()->is_admin())
        {
            $logs = Log::latest()->get();

            return view('admin.Logs',compact('logs'));
        }else{
            return redirect()->action('HomeController@index');
        }
    }

    public function showUsers()
    {
        if(Auth::user()->is_admin() && Auth::user()->Status == 'Active')
        {
            $users = User::where([
                ['id','!=',Auth::id()],
                ['Status','Active'],
            ])->get();
            return view('admin.Users',compact('users'));
        }else{
            return redirect()->action('HomeController@index');
        }
    }

    public function ArchivedFiles()
    {
        if(Auth::user()->is_admin()){
            $files = File::where('Status','Inactive')->get();
            return view('admin.ArchivedFiles',compact(['files']));
            // return var_dump($files);
        }else{
            return redirect()->action('HomeController@index');
        }
    }

    public function LockUser(Request $request)
    {
        User::where('id',$request->user_id)
            ->update(['Status'=>'Inactive']);
        
        $user = User::select('FirstName','MiddleName','LastName')->where('id',$request->user_id)->get();
        $log = new Log;
        $log->Subject = 'User Management';
        $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has locked ".$user[0]['FirstName']." ".$user[0]['MiddleName']." ".$user[0]['LastName'];
        $log->student_id = Auth::id();
        $log->save();
        
        return back();
    }

    public function UnlockUser(Request $request)
    {
        User::where('id',$request->user_id)
            ->update(['Status'=>'Active']);
        
        $user = User::select('FirstName','MiddleName','LastName')->where('id',$request->user_id)->get();
        $log = new Log;
        $log->Subject = 'User Management';
        $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has unlocked ".$user[0]['FirstName']." ".$user[0]['MiddleName']." ".$user[0]['LastName'];
        $log->student_id = Auth::id();
        $log->save();

        return back();
    }

    public function PromoteUser(Request $request)
    {
        User::where('id',$request->user_id2)
            ->update(['Role'=>'Encoder']);
        
        $user = User::select('FirstName','MiddleName','LastName')->where('id',$request->user_id2)->get();
        $log = new Log;
        $log->Subject = 'User Management';
        $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has promoted ".$user[0]['FirstName']." ".$user[0]['MiddleName']." ".$user[0]['LastName']." to Encoder";
        $log->student_id = Auth::id();
        $log->save();
        
        return back();
    }

    public function DemoteUser(Request $request)
    {
        User::where('id',$request->user_id2)
            ->update(['Role'=>'User']);
        
        $user = User::select('FirstName','MiddleName','LastName')->where('id',$request->user_id2)->get();
        $log = new Log;
        $log->Subject = 'User Management';
        $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has demoted ".$user[0]['FirstName']." ".$user[0]['MiddleName']." ".$user[0]['LastName'];
        $log->student_id = Auth::id();
        $log->save();

        return back();
    }

    public function InactiveUsers()
    {
        if(Auth::user()->is_admin()){
            $users = User::where('Status','Inactive')->get();
            return view('admin.InactiveUsers',compact('users'));
        }else{
            return redirect()->action('HomeController@index');
        }
    }

    public function Reports()
    {
        // Charts::database(File::get(), 'bar', 'highcharts')
        //     ->dateColumn('thesis_date')
        //     ->title('Thesis per Course per Year')
        //     ->elementLabel("Total Files")
        //     ->dimensions(1000, 500)
        //     ->responsive(True)
        //     ->lastByYear();
        $years = File::distinct()->latest()->get([DB::raw('YEAR(thesis_date) AS year')]);
        $courses = File::distinct()->select('Course')->get();
        $chart_course_year = Charts::multiDatabase('bar', 'highcharts')
            ->dateColumn('thesis_date')
            ->dataset('BSIT', File::where('Course','BSIT')->get())
            ->dataset('BSCS', File::where('Course','BSCS')->get())
            ->dataset('BSIS', File::where('Course','BSIS')->get())
            ->title('Thesis Per Course Per Year')
            ->elementLabel("Total Files")
            ->dimensions(1000, 500)
            ->colors(['rgb(46,112,160)', 'rgb(192,65,62)','orange'])
            ->lastByYear();
        return view('admin.Reports',compact(['years','courses','chart_course_year']));
        // return var_dump(File::distinct()->select('Course')->get()->toArray()[0]['Course']);
    }
}
