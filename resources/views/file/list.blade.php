@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>All Thesis</h2>
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>No.</th>
								<th>Title</th>
								<th>Author/s</th>
								<th>Adviser</th>
								<th>Thesis Date</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1; ?>
							@foreach($files as $file)
							<tr>
								<td>{{$no++}}</td>
								<td>{{ $file->FileTitle }}</td>
								<td>{{ $file->Authors }}</td>
								<td>{{ $file->Adviser }}</td>
								<td>{{ $file->created_at }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
			</div>
			</div>
		</div>
	</div>
@endsection