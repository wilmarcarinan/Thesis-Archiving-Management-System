@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Title</th>
						<th>Description</th>
						<th>Date Submitted</th>
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
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
@stop