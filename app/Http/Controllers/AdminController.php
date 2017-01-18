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
    	return view('home');
    }

    public function showLogs()
    {
        if(Auth::user()->Role == 'Admin')
        {
            $logs = Log::get();

            return view('admin.Logs',compact('logs'));
        }
        return view('home');      
    }

    public function showUsers()
    {
        if(Auth::user()->Role == 'Admin')
        {
            $users = User::where('id','!=',Auth::id())->get();

            return view('admin.Users',compact('users'));
        }
        return view('home');   
    }
}
