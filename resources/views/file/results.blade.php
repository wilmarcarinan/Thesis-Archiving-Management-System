@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			@if(Auth::user()->Role == 'Admin')
				<div class="col-md-11 col-md-offset-1">
			@else
				<div class="col-md-12">
			@endif
					@if($files == '[]')
						@if(Auth::user()->Role == 'Admin')
							<a href="/AddFile" class="btn btn-primary" id="AddFileBtn">Add Thesis</a>
						@endif
						<h3 style="margin-left:20px">Not Found</h3>
					@else
						@if(Auth::user()->Role == 'Admin')
							<a href="/AddFile" class="btn btn-primary" id="AddFileBtn">Add Thesis</a>
						@endif
						<div class="table-responsive" id="FileTable">
							<table class="table table-hover">
								<thead>
									<tr>
										<th><span class="glyphicon glyphicon-sort-by-order"></span></th>
										<th>Title</th>
										<th>Category</th>
										<th>Author/s</th>
										<th>Adviser</th>
										<th>Thesis Date</th>
										<th><span class="glyphicon glyphicon-eye-open"></span></th>
                						<th><span class="glyphicon glyphicon-star-empty"></span></th>
										@if(Auth::user()->Role == 'Admin')
											<th>Status</th>
											<th></th>
										@endif
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