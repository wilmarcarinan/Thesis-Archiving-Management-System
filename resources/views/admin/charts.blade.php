@extends('layouts.app')

@section('header')
    {!! Charts::assets() !!}
@endsection

@section('content')
<center>	
	<div class="container">
		<div class="row">
			<div class="col-md-5 col-md-offset-2" style="padding: 10px 15px;">
				{!! $chart->render() !!}
			</div>
			<div class="col-md-5" style="padding: 10px 20px;">
				{!! $chart2->render() !!}
			</div>
			<div class="col-md-10 col-md-offset-2" style="padding: 10px 0px 10px;">
				{!! $chart3->render() !!}
			</div>
		</div>
	</div>

</center>
@endsection