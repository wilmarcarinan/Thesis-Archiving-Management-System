<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        if(Auth::user()->Role == 'Admin') // && \Auth::user()->Status == 'Active'
        {
            return view('admin.AdminPage');
        }
        $files = File::latest('thesis_date')->paginate(5);
        $latest_file = File::latest('thesis_date')->first();
        // $favorites = Auth::user()->favorites();
        return view('home',compact(['files','latest_file']));
        // return var_dump($favorites);
    }
}
