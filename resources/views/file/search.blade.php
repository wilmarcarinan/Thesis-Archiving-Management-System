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
								<td>
									<!-- Button trigger modal -->
									<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
										View here..
									</button>

									<!-- Modal -->
									<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" id="myModalLabel">Abstract</h4>
												</div>
												<div class="modal-body">
													{{ $file->FileDescription }}
													<br>{!! QrCode::size(300)->generate('localhost:8000'.$file->FilePath); !!}
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>
								</td>
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