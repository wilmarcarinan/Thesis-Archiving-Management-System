@extends('layouts.app')

@section('header')
    {!! Charts::assets() !!}
@endsection

@section('content')
<style type="text/css">
	.charty{
		height: 100%;
		width: 100%;
	}
</style>
<center>
	<div class="container">
		<div class="col-md-10 col-md-offset-1" style="padding: 10px 0px 10px ;">
			<ul class="nav nav-pills">
				<li class="active"><a data-toggle="tab" href="#dailyview">Daily</a></li>
				<li><a data-toggle="tab" href="#monthlyview">Monthly</a></li>
				<li><a data-toggle="tab" href="#yearlyview">Yearly</a></li>
			</ul>
			<div class="tab-content">
					<div id="dailyview" class="tab-pane fade in active">
						{!! $chartvd->render() !!}
					<p class="padding: 10px 10px 10px 10px">{!! $chartud->render() !!}</p>
					<p class="padding: 10px 10px 10px 10px">{!! $chartld->render() !!}</p>
					</div>
					<div id="monthlyview" class="tab-pane fade in active">
						{!! $chartvm->render() !!}
					<p class="padding: 10px 10px 10px 10px">{!! $chartum->render() !!}</p>
					<p class="padding: 10px 10px 10px 10px">{!! $chartlm->render() !!}</p>	
					</div>
					<div id="yearlyview" class="tab-pane fade in active">
						{!! $chartvy->render() !!}
					<p class="padding: 10px 10px 10px 10px">{!! $chartuy->render() !!}</p>
					<p class="padding: 10px 10px 10px 10px">{!! $chartly->render() !!}</p>
					</div>				
			</div>			
		</div>		
	
	<script>
		$(document).ready(function(){$("#yearlyview , #monthlyview").removeClass("in active");});
	</script>
<!-- 	<div>
		<div class="col-md-5" style="padding: 10px 10px 10px 10px;">
			<ul class="nav nav-pills">
				<li class="active"><a data-toggle="tab" href="#dailyupload">Daily</a></li>
				<li><a data-toggle="tab" href="#monthlyupload">Monthly</a></li>
				<li><a data-toggle="tab" href="#yearlyupload">Yearly</a></li>
			</ul>
			<div class="tab-content">
				<div id="dailyupload" class="tab-pane fade in active">
					{!! $chartud->render() !!}
				</div>
				<div id="monthlyupload" class="tab-pane fade in active">
					{!! $chartum->render() !!}
				</div>
				<div id="yearlyupload" class="tab-pane fade in active">
					{!! $chartuy->render() !!}
				</div>
			</div>			
		</div>
	</div> -->
	<script>
		$(document).ready(function(){$("#yearlyupload , #monthlyupload").removeClass("in active");});
	</script>
<!-- 		<div class="container">
		<div class="col-md-10 col-md-offset-2" style="padding: 10px 0px 10px;">
			<ul class="nav nav-pills">
				<li class="active"><a data-toggle="tab" href="#dailylogin">Daily</a></li>
				<li><a data-toggle="tab" href="#monthlylogin">Monthly</a></li>
				<li><a data-toggle="tab" href="#yearlylogin">Yearly</a></li>
			</ul>
			<div class="tab-content">
				<div id="dailylogin" class="tab-pane fade in active">
					{!! $chartld->render() !!}
				</div>
				<div id="monthlylogin" class="tab-pane fade in active">
					{!! $chartlm->render() !!}
				</div>
				<div id="yearlylogin" class="tab-pane fade in active">
					{!! $chartly->render() !!}
				</div>
			</div>			
		</div>		
	</div> -->
	<script>
		$(document).ready(function(){$("#yearlylogin , #monthlylogin").removeClass("in active");});
	</script>	
</center>
@endsection