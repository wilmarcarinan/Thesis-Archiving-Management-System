<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\File;

class SettingsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	return view('settings');
        //Auth::logout();
    }

    public function update()
    {
    	$this->validate(request(),[
    		'FirstName' => 'required',
    		'MiddleName' => 'required',
    		'LastName' => 'required',
    		'Course' => 'required',
    		'College' => 'required',
    		// 'email' => 'required|email|unique:users,email,' .auth()->id(),
    		'email' => ['required','email',Rule::unique('users')->ignore(auth()->id())],
    		'NewPassword' => 'required|min:6|confirmed'
    	]);

    	auth()->user()->update([
    		'FirstName' => request('FirstName'),
    		'MiddleName' => request('MiddleName'),
    		'LastName' => request('LastName'),
    		'Course' => request('Course'),
    		'College' => request('College'),
    		'email' => request('email'),
    		'password' => bcrypt(request('NewPassword'))
    	]);

    	if(Auth::user()->Role == 'Admin'){
    		return view('admin.AdminPage');
    	}else{
            $files_latest = File::latest()->paginate(5);
            $latest_file = File::latest()->first();
    		return view('home',compact(['files_latest','latest_file']));
    	}

    }
}
