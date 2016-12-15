<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	return view('settings');
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
    		'password' => 'required'
    	]);

    	auth()->user()->update([
    		'FirstName' => request('FirstName'),
    		'MiddleName' => request('MiddleName'),
    		'LastName' => request('LastName'),
    		'Course' => request('Course'),
    		'College' => request('College'),
    		'email' => request('email'),
    		'password' => bcrypt(request('password'))
    	]);

    	if(\Auth::user()->Role == 'Admin'){
    		return view('admin.AdminPage');
    	}else{
    		return view('home');
    	}

    }
}
