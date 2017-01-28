@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
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
									<th>No.</th>
									<th>Title</th>
									<th>Abstract</th>
									<th>Thesis Date</th>
									@if(Auth::user()->Role == 'Admin')
										<th>Status</th>
										<th></th>
									@endif
								</tr>
							</thead>
							<tbody>
								<?php $no=1; ?>
								<p class="QRCode hidden">
									@if(Request::server('SERVER_NAME') <> '127.0.0.1')
										<?php 
											$path='http://'.Request::server('SERVER_NAME').'/pdf.js/web/viewer.html?file=http://'.Request::server('SERVER_NAME');
											echo $path;
										?>
									@else
										<?php 
											$path='http://localhost:8000/pdf.js/web/viewer.html?file=http://localhost:8000';
											echo $path;
										?>
									@endif
									
								</p>
								@foreach($files as $file)
								<tr class="file">
									<td>{{$no++}}</td>
									<td>
										@if(Request::server('SERVER_NAME') <> '127.0.0.1')
											<a href="/pdf.js/web/viewer.html?file=http://{{ Request::server('SERVER_NAME').$file->FilePath }}" target="_blank">
										@else
											<a href="/pdf.js/web/viewer.html?file=http://localhost:8000{{$file->FilePath }}" target="_blank">
										@endif
											{{ $file->FileTitle }}
										</a>
									</td>
									<td>
										<!-- Button trigger modal -->
										<button type="button" class="btn btn-primary btn-sm viewInfo" data-toggle="modal" data-target="#myModal" data-title="{{$file->FileTitle}}" data-abstract="{{$file->Abstract}}" data-path="{{$file->FilePath}}">
											View here..
										</button>

										<!-- Modal -->
										<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title" id="myModalLabel"></h4>
													</div>
													<div class="modal-body">
														<p class="abstract"></p>
														<br>
														{{-- {!! QrCode::size(300)->generate('http://'.Request::server('SERVER_NAME').'/pdf.js/web/viewer.html?file=http://'.Request::server('SERVER_NAME').$file->FilePath) !!} --}}
														
														<p class="qrcodeCanvas">
																
														</p>
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
										<td>{{ $file->Status }}</td>
										<td>
											<a href="#" class="btn btn-primary btn-sm">Update</a>
										</td>
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