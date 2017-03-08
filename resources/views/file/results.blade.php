@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			@if(Auth::user()->is_admin())
			<div class="col-md-12 jumbotron">
			@else
			<div class="col-md-12">
			@endif
				@if(!$files->count())
					{{-- @if(!empty($requests['search']) && empty($requests['Adviser']) && empty($requests['Year'])) --}}
						<h3 style="margin:50px 0px 0px 20px">No "{{$requests['search']}}" Found.</h3>
					{{-- @endif --}}
				{{-- @elseif(empty($requests['search']))
					<h3 style="margin:50px 0px 0px 20px">Sorry! You didn't input any keywords.</h3> --}}
				@else
					<table class="table" cellspacing="0" width="100%" id="FileTable">
						<thead>
	                      <tr>
	                        @if(Auth::user()->Role <> 'Admin')
	                            <th></th>
	                            <th></th>
	                            <th></th>
	                        @else
	                            <th></th>
	                            <th></th>
	                        @endif
	                        <th class="hidden">Abstract</th>
	                        <th class="hidden">Authors</th>
	                        <th class="hidden">Adviser</th>
	                        <th>Title</th>
	                        <th>Subject Area</th>
	                        <th>Tags</th>
	                        {{-- <th>Author/s</th> --}}
	                        <th>Course</th>
	                        {{-- <th>Adviser</th> --}}
	                        <th>Thesis Date</th>
	                        @if(Auth::user()->Role == 'Admin')
	                            <th>Status</th>
	                        @endif
	                        <th><span class="glyphicon glyphicon-eye-open"></span></th>
	                        <th><span class="glyphicon glyphicon-star-empty"></span></th>
	                      </tr>
	                    </thead>
						<tbody>
							@include('file.table-contents')
						</tbody>
					</table>
				@endif
			</div>
		</div>
	</div>
@endsection

@section('script-section')
<script>
    $(document).ready(function(){
        $('#FileTable').DataTable({
            responsive: true
        });
    });
</script>
@endsection