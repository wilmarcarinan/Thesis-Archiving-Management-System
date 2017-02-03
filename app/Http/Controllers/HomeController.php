<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\File;
use Charts;

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
            $chart = Charts::create('area', 'highcharts')
                    ->title('Dashboard')
                    ->labels(['First', 'Second', 'Third'])
                    ->values([5,10,20])
                    ->dimensions(1000,500)
                    ->responsive(false);
            return view('admin.charts', ['chart' => $chart]);
        }
        $files = File::latest('thesis_date')
                ->where('Status','Active')
                ->paginate(5);
        $latest_file = File::latest('thesis_date')
                    ->where('Status','Active')
                    ->first();
        $favorites = DB::table('favorites')->where('user_id',Auth::id())->pluck('file_id')->all();
        $bookmarks = DB::table('bookmarks')->where('user_id',Auth::id())->pluck('file_id')->all();
        return view('home',compact(['files','latest_file', 'favorites', 'bookmarks']));
        // return var_dump($favorites);
    }
}
