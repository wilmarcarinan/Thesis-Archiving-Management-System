<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\File;
use App\Log;
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
           /* $chart = Charts::create('area', 'highcharts')
            ->title('Views per day')
            ->labels(['day1', 'day2', 'day3'])
            ->elementLabel("Total")
            ->values([5,10,20])
            ->dimensions(780,350)
            ->responsive(True);*/


            //chart for views
            $chartvd = Charts::database(User::all(), 'bar', 'highcharts')
            ->title('Views per day')
            ->elementLabel("Total")
            ->dimensions(1000, 500)
            ->responsive(True)
            ->groupByDay();

            $chartvm = Charts::database(User::all(), 'bar', 'highcharts')
            ->title('Views per month')
            ->elementLabel("Total")
            ->dimensions(1000, 500)
            ->responsive(True)
            ->groupByMonth();

            $chartvy = Charts::database(User::all(), 'bar', 'highcharts')
            ->title('Views per year')
            ->elementLabel("Total")
            ->dimensions(1000, 500)
            ->responsive(True)
            ->groupByYear();

            //chart for uploads
            $chartud = Charts::database(File::all(), 'area', 'highcharts')

            ->title('Uploads')
            ->title('Uploaded Files per day')
            ->elementLabel("Total")
            ->dimensions(1000, 500)
            ->responsive(True)
            ->groupByDay();

            $chartum = Charts::database(File::all(), 'area', 'highcharts')
            ->title('Uploads')
            ->title('Uploaded Files per month')
            ->elementLabel("Total")
            ->dimensions(1000, 500)
            ->responsive(True)
            ->groupByMonth();

            $chartuy = Charts::database(File::all(), 'area', 'highcharts')

            ->title('Uploads')
            ->title('Uploaded Files per year')
            ->elementLabel("Total")
            ->dimensions(1000, 500)
            ->responsive(True)
            ->groupByYear();

            //chart for login
            
            $chartld = Charts::database(Log::where('Subject','Login')->get(), 'bar', 'highcharts')

            ->title('Log In')
            ->title('User Logged in per day')
            ->elementLabel("Total")
            ->dimensions(1000, 500)
            ->responsive(True)
            ->groupByDay();

            $chartlm = Charts::database(Log::where('Subject','Login')->get(), 'bar', 'highcharts')

            ->title('Log In')
            ->title('Users Logged in month')
            ->elementLabel("Total")
            ->dimensions(1000, 500)
            ->responsive(True)
            ->groupByMonth();

            $chartly = Charts::database(Log::where('Subject','Login')->get(), 'bar', 'highcharts')
            ->title('Log In')
            ->title('Users Logged in per year')
            ->elementLabel("Total")
            ->dimensions(1000, 500)
            ->responsive(True)
            ->groupByYear();

            // $chart2 = Charts::create('bar', 'highcharts')
            // ->title('User login per day')
            // ->elementLabel("Total")
            // ->labels(['day1', 'day2', 'day3'])
            // ->values([5,10,20])
            // ->dimensions(780,350)
            // ->responsive(True);

            // $chart2 = Charts::database(File::all(), 'bar', 'highcharts')
            // ->title('Files uploaded per day')
            // ->elementLabel("Total")
            // ->dimensions(1000, 500)
            // ->responsive(false)
            // ->groupByDay();

            // $chart3 = Charts::create('line', 'highcharts')
            // ->title('Files uploaded per day')
            // ->elementLabel("Total")
            // ->labels(['day1', 'day2', 'day3'])
            // ->values([5,10,20])
            // ->dimensions(780,350)
            // ->responsive(True);

            // $chart3 = Charts::database(Log::where('Subject','Login')->get(), 'bar', 'highcharts')
            // ->title('Log In per day')
            // ->elementLabel("Total")
            // ->dimensions(1000, 500)
            // ->responsive(false)
            // ->groupByDay();

            // $chart3 = Charts::multi('areaspline', 'highcharts')
            // ->title('Burndown Chart')
            // ->colors(['rgb(46,112,160)', 'rgb(192,65,62)'])
            // ->labels(['Sprint 1', 'Sprint 2', 'Sprint 3', 'Sprint 4'])
            // ->elementLabel('Total Story Points')
            // ->dataset('Ideal Story Points', [11,32,58,74])
            // ->dataset('Current Story Points Completed',[11,11,11,11])
            // ->dimensions(780,350)
            // ->responsive(True);

            return view('admin.charts');

        }else{
            $files = File::latest('thesis_date')
                ->where('Status','Active')
                ->paginate(5);
            $latest_file = File::latest('thesis_date')
                ->where('Status','Active')
                ->first();
            $most_viewed = File::orderBy('no_of_views','DESC')->get();
            $favorites = DB::table('favorites')->where('user_id',Auth::id())->pluck('file_id')->all();
            $bookmarks = DB::table('bookmarks')->where('user_id',Auth::id())->pluck('file_id')->all();
            return view('home',compact(['files','latest_file', 'favorites', 'bookmarks', 'most_viewed']));
        }
        // return var_dump($favorites);
    }

    public function getchartvd(){

        if(Auth::user()->Role == 'Admin') // && \Auth::user()->Status == 'Active'
        {
            $chartvd = Charts::database(User::all(), 'bar', 'highcharts')
            ->title('Views per day')
            ->elementLabel("Total")
            ->dimensions(1000, 500)
            ->responsive(True)
            ->groupByDay();
            return $chartvd->render();
        }else{
            return "doon sa kanto";
        }
    }

    public function getchartvm(){

        if(Auth::user()->Role == 'Admin') // && \Auth::user()->Status == 'Active'
        {
            $chartvm = Charts::database(User::all(), 'bar', 'highcharts')
            ->title('Views per month')
            ->elementLabel("Total")
            ->dimensions(1000, 500)
            ->responsive(True)
            ->groupByMonth();
            return $chartvm->render();
        }else{
            return "doon sa kanto";
        }
    }

    public function getchartvy(){

        if(Auth::user()->Role == 'Admin') // && \Auth::user()->Status == 'Active'
        {
           $chartvy = Charts::database(User::all(), 'bar', 'highcharts')
            ->title('Views per year')
            ->elementLabel("Total")
            ->dimensions(1000, 500)
            ->responsive(True)
            ->groupByYear();
            return $chartvy->render();
        }else{
            return "doon sa kanto";
        }
    }

    public function getchartud(){

        if(Auth::user()->Role == 'Admin') // && \Auth::user()->Status == 'Active'
        {
           //chart for uploads
            $chartud = Charts::database(File::all(), 'area', 'highcharts')

            ->title('Uploads')
            ->title('Uploaded Files per day')
            ->elementLabel("Total")
            ->dimensions(1000, 500)
            ->responsive(True)
            ->groupByDay();
            return $chartud->render();
        }else{
            return "doon sa kanto";
        }
    }

    public function getchartum(){

        if(Auth::user()->Role == 'Admin') // && \Auth::user()->Status == 'Active'
        {
           //chart for uploads
            $chartum = Charts::database(File::all(), 'area', 'highcharts')
            ->title('Uploads')
            ->title('Uploaded Files per month')
            ->elementLabel("Total")
            ->dimensions(1000, 500)
            ->responsive(True)
            ->groupByMonth();
            return $chartum->render();
        }else{
            return "doon sa kanto";
        }
    }

    public function getchartuy(){

        if(Auth::user()->Role == 'Admin') // && \Auth::user()->Status == 'Active'
        {
           //chart for uploads
            $chartuy = Charts::database(File::all(), 'area', 'highcharts')

            ->title('Uploads')
            ->title('Uploaded Files per year')
            ->elementLabel("Total")
            ->dimensions(1000, 500)
            ->responsive(True)
            ->groupByYear();
            return $chartuy->render();
        }else{
            return "doon sa kanto";
        }
    }

    public function getchartld(){

        if(Auth::user()->Role == 'Admin') // && \Auth::user()->Status == 'Active'
        {
            //chart for login
            
            $chartld = Charts::database(Log::where('Subject','Login')->get(), 'bar', 'highcharts')

            ->title('Log In')
            ->title('User Logged in per day')
            ->elementLabel("Total")
            ->dimensions(1000, 500)
            ->responsive(True)
            ->groupByDay();
            return $chartld->render();
        }else{
            return "doon sa kanto";
        }
    }

    public function getchartlm(){

        if(Auth::user()->Role == 'Admin') // && \Auth::user()->Status == 'Active'
        {
            $chartlm = Charts::database(Log::where('Subject','Login')->get(), 'bar', 'highcharts')
            ->title('Log In')
            ->title('Users Logged in month')
            ->elementLabel("Total")
            ->dimensions(1000, 500)
            ->responsive(True)
            ->groupByMonth();
            return $chartlm->render();
        }else{
            return "doon sa kanto";
        }
    }

    public function getchartly(){

        if(Auth::user()->Role == 'Admin') // && \Auth::user()->Status == 'Active'
        {

            $chartly = Charts::database(Log::where('Subject','Login')->get(), 'bar', 'highcharts')
            ->title('Log In')
            ->title('Users Logged in per year')
            ->elementLabel("Total")
            ->dimensions(1000, 500)
            ->responsive(True)
            ->groupByYear();
            return $chartly->render();
        }else{
            return "doon sa kanto";
        }
    }
}
