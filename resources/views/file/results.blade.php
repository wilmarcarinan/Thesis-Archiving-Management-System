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
						<h3 style="margin-left:20px">Not Found</h3>
					@else
						<div class="table-responsive" id="FileTable">
							<table class="table table-hover">
								<thead>
									<tr>
										@if(Auth::user()->Role <> 'Admin')
											<th></th>
											<th></th>
										@endif
										<th><span class="glyphicon glyphicon-sort-by-order"></span></th>
										<th>Title</th>
										<th>Category</th>
										<th>Author/s</th>
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