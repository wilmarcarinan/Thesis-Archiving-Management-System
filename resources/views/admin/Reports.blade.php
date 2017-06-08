@extends('layouts.app')

@section('header')
	{!! Charts::assets() !!}
@endsection

@section('content')
<div class="container">
	@if(session('status'))
        <div class="alert alert-success" style="margin: 20px 0px 15px 0px">
            <li style="list-style: none">{{session('status')}}</li>
        </div>
    @endif
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

	<div class="row jumbotron">
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
	</div>

	<div class="row jumbotron">
		<div class="col-md-6">
			<caption>As of {{\Carbon\Carbon::now()->format('M d, Y h:i:s a')}}</caption>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>Subject Area</th>
							@foreach($years as $year)
							<th>{{$year->year}}</th>
							@endforeach
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						@foreach($subjects as $subject)
						<tr>
							<td>
								{{$subject->SubjectArea}}
							</td>
							@foreach($years as $year)
							<td>{{App\File::where([['SubjectArea',$subject->SubjectArea],[DB::raw('YEAR(thesis_date)'), $year->year]])->get()->count()}}</td>
							@endforeach
							<td>{{App\File::where('SubjectArea',$subject->SubjectArea)->get()->count()}}</td>
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
			{!! $chart_subject_year->render() !!}
		</div>
	</div>
</div>
@endsection