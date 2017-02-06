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
            $logs = Log::paginate(15);

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
        
        return back();
    }

    public function UnlockUser(Request $request)
    {
        User::where('id',$request->user_id)
            ->update(['Status'=>'Active']);
        
        return back();
    }
}
