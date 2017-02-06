<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\File;
use App\Log;

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

        $log = new Log;
        $log->Subject = 'Settings';
        $log->Details = Auth::user()->FirstName." ".Auth::user()->MiddleName." ".Auth::user()->LastName." [".Auth::user()->Role."] has updated his/her settings.";
        $log->student_id = Auth::id();
        $log->save();

    	if(Auth::user()->Role == 'Admin'){
    		return view('admin.AdminPage');
    	}else{
    		return redirect()->action('HomeController@index');
    	}

    }
}
