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
            ->title('Dashboard')
            ->labels(['First', 'Second', 'Third'])
            ->values([5,10,20])
            ->dimensions(1000,500)
            ->responsive(false);
        return view('admin.charts', ['chart' => $chart]);
    }
}