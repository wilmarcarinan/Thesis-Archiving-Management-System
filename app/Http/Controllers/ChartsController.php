<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Charts;

class ChartsController extends Controller
{
    public function index()
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

        return view('admin.charts', [
            'chart' => $chart, 
            'chart2' => $chart2,
            'chart3' => $chart3
            ]);
    }
}