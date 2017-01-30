<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Log;
use App\User;

class AdminController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	if(Auth::user()->Role == 'Admin')
    	{
    		return view('admin.AdminPage');
    	}
        else{
            $files_latest = File::latest()->paginate(5);
            $latest_file = File::latest()->first();
            return view('home',compact(['files_latest','latest_file']));
        }
    }

    public function showLogs()
    {
        if(Auth::user()->Role == 'Admin')
        {
            $logs = Log::paginate(15);

            return view('admin.Logs',compact('logs'));
        }else{
            $files_latest = File::latest()->paginate(5);
            $latest_file = File::latest()->first();
            return view('home',compact(['files_latest','latest_file']));
        }
    }

    public function showUsers()
    {
        if(Auth::user()->Role == 'Admin')
        {
            $users = User::where('id','!=',Auth::id())->paginate(15);
            return view('admin.Users',compact('users'));
        }else{
            $files_latest = File::latest()->paginate(5);
            $latest_file = File::latest()->first();
            return view('home',compact(['files_latest','latest_file']));
        }
    }
}
