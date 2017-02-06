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
            ->title('Views per day')
            ->labels(['day1', 'day2', 'day3'])
            ->elementLabel("Total")
            ->values([5,10,20])
            ->dimensions(780,350)
            ->responsive(True);

            $chart2 = Charts::create('bar', 'highcharts')
            ->title('User login per day')
            ->elementLabel("Total")
            ->labels(['day1', 'day2', 'day3'])
            ->values([5,10,20])
            ->dimensions(780,350)
            ->responsive(True);

            $chart3 = Charts::create('line', 'highcharts')
            ->title('Files uploaded per day')
            ->elementLabel("Total")
            ->labels(['day1', 'day2', 'day3'])
            ->values([5,10,20])
            ->dimensions(780,350)
            ->responsive(True);

            // $chart3 = Charts::multi('areaspline', 'highcharts')
            // ->title('Burndown Chart')
            // ->colors(['rgb(46,112,160)', 'rgb(192,65,62)'])
            // ->labels(['Sprint 1', 'Sprint 2', 'Sprint 3', 'Sprint 4'])
            // ->elementLabel('Total Story Points')
            // ->dataset('Ideal Story Points', [11,32,58,74])
            // ->dataset('Current Story Points Completed',[11,11,11,11])
            // ->dimensions(780,350)
            // ->responsive(True);

            return view('admin.charts', [
                'chart' => $chart, 
                'chart2' => $chart2,
                'chart3' => $chart3
                ]);
        }else{
            $files = File::latest('thesis_date')
                ->where('Status','Active')
                ->paginate(5);
            $latest_file = File::latest('thesis_date')
            ->where('Status','Active')
            ->first();
            $favorites = DB::table('favorites')->where('user_id',Auth::id())->pluck('file_id')->all();
            $bookmarks = DB::table('bookmarks')->where('user_id',Auth::id())->pluck('file_id')->all();
            return view('home',compact(['files','latest_file', 'favorites', 'bookmarks']));
        }
        // return var_dump($favorites);
    }
}
