{{-- <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{config('app.name')}}</title>
	<style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
</head>
<body>
	<center>
		<h3>Technological University of the Philippines</h3>
		<p>Ayala Blvd. Ermita, Manila</p>
	</center>
</body>
</html> --}}

@extends('layouts.app')

@section('header')
	{!! Charts::assets() !!}
@endsection

@section('content')
<div class="container">
	<div class="row jumbotron">
		<div class="col-md-6">
			<caption>As of {{\Carbon\Carbon::now()->format('M d, Y h:i:s a')}}</caption>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>Course</th>
							@foreach($years as $year)
							<th>{{$year->year}}</th>
							@endforeach
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						@foreach($courses as $course)
						<tr>
							<td>{{$course->Course}}</td>
							@foreach($years as $year)
							<td>{{App\File::where([['Course',$course->Course],[DB::raw('YEAR(thesis_date)'), $year->year]])->get()->count()}}</td>
							@endforeach
							<td>{{App\File::where('Course',$course->Course)->get()->count()}}</td>
						</tr>
						@endforeach
						<tr>
							<td>Total</td>
							@foreach($years as $year)
							<td>{{App\File::where(DB::raw('YEAR(thesis_date)'), $year->year)->get()->count()}}</td>
							@endforeach
							<td>{{App\File::get()->count()}}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-6">
			{!! $chart_course_year->render() !!}
		</div>
	</div>

	{{-- <div class="row jumbotron">
		<div class="col-md-6">
			<caption>As of {{\Carbon\Carbon::now()->format('M d, Y h:i:s a')}}</caption>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>Adviser</th>
							@foreach($years as $year)
							<th>{{$year->year}}</th>
							@endforeach
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						@foreach($advisers as $adviser)
						<tr>
							<td>
								@if($adviser->Adviser == '')
								No Adviser
								@else
								{{$adviser->Adviser}}
								@endif
							</td>
							@foreach($years as $year)
							<td>{{App\File::where([['Adviser',$adviser->Adviser],[DB::raw('YEAR(thesis_date)'), $year->year]])->get()->count()}}</td>
							@endforeach
							<td>{{App\File::where('Adviser',$adviser->Adviser)->get()->count()}}</td>
						</tr>
						@endforeach
						<tr>
							<td>Total</td>
							@foreach($years as $year)
							<td>{{App\File::where(DB::raw('YEAR(thesis_date)'), $year->year)->get()->count()}}</td>
							@endforeach
							<td>{{App\File::get()->count()}}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-6">
			{!! $chart_adviser_year->render() !!}
		</div>
	</div> --}}
</div>
@endsection