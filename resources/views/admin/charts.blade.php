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
<script type="text/javascript">
	function checkWilmaActivity(){
		if($('#monthlyview').attr('numC')>=3){
			setTimeout(function() {
				$("#monthlyview").removeClass("in active");
		    }, 1000);
			
		}
		if($('#yearlyview').attr('numC')>=3){
			setTimeout(function() {
				$("#yearlyview").removeClass("in active");
		    }, 1000);
		}
	}
</script>
	<div class="container">
		@if(session('status'))
            <div class="alert alert-success" style="margin: 20px 0px 15px 0px">
                <li style="list-style: none; text-align: left;">{{session('status')}}</li>
            </div>
        @endif
		<div class="col-md-10 col-md-offset-1" style="padding: 10px 0px 10px ;">
			<ul class="nav nav-pills">
				<li class="active"><a data-toggle="tab" href="#dailyview">Daily</a></li>
				<li><a data-toggle="tab" href="#monthlyview">Monthly</a></li>
				<li><a data-toggle="tab" href="#yearlyview">Yearly</a></li>
			</ul>
			<div class="tab-content">
				<div id="dailyview" class="tab-pane fade in active">
					<div id="getchartvd" style="padding: 10px 0px 0px 0px">
						<script>
							$.get( "/getchartvd" )
							  .done(function( data ) {
								$('#getchartvd').html(data);
							  });
						</script>{{-- {!! $chartvd->render() !!} --}}
					</div>
					<p  id="getchartud" style="padding: 10px 0px 0px 0px">
						<script>
							$.get( "/getchartud" )
							  .done(function( data ) {
								$('#getchartud').html(data);
							  });
						</script>
					{{-- {!! $chartud->render() !!} --}}
					</p>
					<p id="getchartld">
						<script>
							$.get( "/getchartld" )
							  .done(function( data ) {
								$('#getchartld').html(data);
							  });
						</script>
						{{-- {!! $chartld->render() !!} --}}
					</p>
				</div>

				<div id="monthlyview" class="tab-pane fade in active" numC="0">
					<div id="getchartvm" style="padding: 10px 0px 0px 0px">{{-- {!! $chartvm->render() !!} --}}
					</div>
					<script>
						$.get( "/getchartvm" )
						  .done(function( data ) {
						  	$('#monthlyview').attr('numC',($('#monthlyview').attr('numC')+1));
							$('#getchartvm').html(data);
						  	checkWilmaActivity();
						  });
					</script>
					<p id="getchartum" style="padding: 10px 0px 0px 0px">{{-- {!! $chartum->render() !!} --}}</p>
					<script>
						$.get( "/getchartum" )
						  .done(function( data ) {
						  	$('#monthlyview').attr('numC',($('#monthlyview').attr('numC')+1));
							$('#getchartum').html(data);
						  	checkWilmaActivity();
						  });
					</script>
					<p id="getchartlm">{{-- {!! $chartlm->render() !!} --}}</p>	
					<script>
						$.get( "/getchartlm" )
						  .done(function( data ) {
						  	$('#monthlyview').attr('numC',($('#monthlyview').attr('numC')+1));
							$('#getchartlm').html(data);
						  	checkWilmaActivity();
						  });
					</script>
				</div>

				<div id="yearlyview" class="tab-pane fade in active" numC="0">
					<div id="getchartvy" style="padding: 10px 0px 0px 0px">{{-- {!! $chartvy->render() !!} --}}
					</div>
					<script>
						$.get( "/getchartvy" )
						  .done(function( data ) {
						  	$('#yearlyview').attr('numC',($('#yearlyview').attr('numC')+1));
							$('#getchartvy').html(data);
						  	checkWilmaActivity();
						  });
					</script>
					<p id="getchartuy" style="padding: 10px 0px 0px 0px">{{-- {!! $chartuy->render() !!} --}}</p>
					<script>
						$.get( "/getchartuy" )
						  .done(function( data ) {
						  	$('#yearlyview').attr('numC',($('#yearlyview').attr('numC')+1));
							$('#getchartuy').html(data);
						  	checkWilmaActivity();
						  });
					</script>
					<p id="getchartly">{{-- {!! $chartly->render() !!} --}}</p>
					<script>
						$.get( "/getchartly" )
						  .done(function( data ) {
						  	$('#yearlyview').attr('numC',($('#yearlyview').attr('numC')+1));
							$('#getchartly').html(data);
						  	checkWilmaActivity();
						  });
					</script>
				</div>				
			</div>			
		</div>		
	
	<script>
		$(document).ready(function(){
			//$("#yearlyview , #monthlyview").removeClass("in active");
	});
	</script>
	<script>
		$(document).ready(function(){$("#yearlyupload , #monthlyupload").removeClass("in active");});
	</script>
	<script>
		$(document).ready(function(){$("#yearlylogin , #monthlylogin").removeClass("in active");});
	</script>	
</center>
@endsection