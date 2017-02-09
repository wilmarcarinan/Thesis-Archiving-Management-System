<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Log;
use App\User;
use App\File;

class AdminController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function showLogs()
    {
        if(Auth::user()->Role == 'Admin')
        {
            $logs = Log::latest()->paginate(50);

            return view('admin.Logs',compact('logs'));
        }else{
            return redirect()->action('HomeController@index');
        }
    }

    public function showUsers()
    {
        if(Auth::user()->Role == 'Admin')
        {
            $users = User::where('id','!=',Auth::id())->paginate(15);
            return view('admin.Users',compact('users'));
        }else{
            return redirect()->action('HomeController@index');
        }
    }

    public function ArchivedFiles()
    {
        $files = File::where('Status','Inactive')->paginate(5);
        return view('admin.ArchivedFiles',compact(['files']));
        // return var_dump($files);
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
            ->update(['Role'=>'Admin']);
        
        $user = User::select('FirstName','MiddleName','LastName')->where('id',$request->user_id2)->get();
        $log = new Log;
        $log->Subject = 'User Management';
        $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has promoted ".$user[0]['FirstName']." ".$user[0]['MiddleName']." ".$user[0]['LastName'];
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
}
