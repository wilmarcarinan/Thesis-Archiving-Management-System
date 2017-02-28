@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				@if(!$files->count())
					{{-- @if(!empty($requests['search']) && empty($requests['Adviser']) && empty($requests['Year'])) --}}
						<h3 style="margin:50px 0px 0px 20px">No "{{$requests['search']}}" Found.</h3>
					{{-- @endif --}}
				{{-- @elseif(empty($requests['search']))
					<h3 style="margin:50px 0px 0px 20px">Sorry! You didn't input any keywords.</h3> --}}
				@else
					<div class="table-responsive" id="FileTable">
						<table class="table table-hover">
							<thead>
								<tr>
									@if(Auth::user()->Role <> 'Admin')
										<th></th>
										<th></th>
										<th></th>
									@endif
									<th><span class="glyphicon glyphicon-sort-by-order"></span></th>
									<th>Title</th>
									<th>Category</th>
									<th>Author/s</th>
									<th>Course</th>
									<th>Adviser</th>
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
					</div>
				@endif
			</div>
		</div>
	</div>
@endsection