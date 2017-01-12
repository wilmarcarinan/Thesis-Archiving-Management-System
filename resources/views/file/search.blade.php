@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-md-offset-1">
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
								<th>Title</th>
								<th>Description</th>
								<th>Date Submitted</th>
								@if(Auth::user()->Role == 'Admin')
									<th>Status</th>
								@endif
							</tr>
						</thead>
						<tbody>
							@foreach($files as $file) 
							<tr>
								<td>
									<a href="{{$file->FilePath}}" target="_blank">
										{{ $file->FileTitle }}
									</a>
								</td>
								<td>{{$file->FileDescription}}</td>
								<td>{{ $file->created_at }}</td>
								@if(Auth::user()->Role == 'Admin')
									<td></td>
								@endif
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			@endif
			</div>	
		</div>
	</div>
@endsection