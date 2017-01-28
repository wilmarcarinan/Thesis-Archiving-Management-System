@extends('layouts.app')

@section('content')
<div class="container jumbotron" style="margin-top:50px">
	<div class="col-sm-3"></div>
	<div class="col-sm-6">
		<h2>Search</h2>
		<form method="POST" action="/search">
			{{ csrf_field() }}
			<!--textbox-->
			<div class="input-group col-sm-12" style="padding: 20px 0;">
				<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
				<input id="search" type="text" class="form-control" name="search" placeholder="Search" autofocus>
			</div>
			<!--checkbox-->
			<div class="col-sm-1 col-xs-2"></div>
			<div class="col-sm-5 col-xs-5">
				<!--checkbox loop na lang yung mga available category-->
				<div class="checkbox">
					<label><input type="checkbox" value="">Option 1</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" value="">Option 2</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" value="">Option 3</label>
				</div>
			</div>
			<div class="col-sm-6 col-xs-5">
				<!--checkbox loop na lang yung mga available category-->
				<div class="checkbox">
					<label><input type="checkbox" value="">Option 1</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" value="">Option 2</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" value="">Option 3</label>
				</div>
			</div>

			<!--select-->
			<div class="form-group col-sm-8 col-xs-7">
				<label for="sel1">Adviser:</label>
				<select class="form-control" id="sel1">
					<option>Select Adviser</option>
					<option>renato</option>
					<option>butch</option>
					<option>butcher</option>
					<option>bituonan</option>
				</select>
			</div>
			<div class="form-group col-sm-4 col-xs-5">
				<label for="sel2">Date:</label>
				<select class="form-control" id="sel2">
					<option>Select Year</option>
					<option>2015</option>
					<option>2016</option>
					<option>2017</option>
					<option>2018</option>
				</select>
			</div>
			<div class="col-sm-4 col-xs-3"></div>
			<div class="col-sm-8 col-xs-9">
				<button type="submit" class="btn btn-primary center">Submit</button>
				<button type="reset" class="btn btn-default center">Reset</button>
			</div>
		</form>
	</div>
</div>
</div>
<div class="col-sm-3"></div>
</div>

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
								<?php $path='http://'.Request::server('SERVER_NAME').'/pdf.js/web/viewer.html?file=http://'.Request::server('SERVER_NAME'); echo $path;?>
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
													
													<div class="filepath"></div>
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