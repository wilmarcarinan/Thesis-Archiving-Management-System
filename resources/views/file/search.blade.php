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
							@foreach($files as $file)
							<tr>
								<td>
									@if(Request::server('SERVER_NAME') <> '127.0.0.1')
										<a href="/pdf.js/web/viewer.html?file=http://{{ Request::server('SERVER_NAME').$file->FilePath }}" target="_blank">
									@else
										<a href="/pdf.js/web/viewer.html?file=http://localhost:8000{{$file->FilePath }}" target="_blank">
									@endif
									{{-- <a href="#" onclick="window.open( '/pdf.js/web/viewer.html?file=http://localhost:8000{{$file->FilePath }}', 'name', 'location=no,scrollbars=yes,status=no,toolbar=yes,resizable=yes' )"> --}}
									{{-- <a href="ViewerJS/#{{ $file->FilePath }}" target="_blank"> --}}
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
												{{-- <div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" id="myModalLabel">Abstract</h4>
												</div> --}}
												<div class="modal-body">
													{{ $file->Abstract }}
													{{-- <br>
													<p>Adopting advanced information technologies within the present broad
													application fields requires precise security. However, security problems regarding
													information privacy have occurred frequently over the last 5 years despite the
													contribution of these technologies. To respond to the need for securing
													information privacy, the Information Privacy Law was enacted on April 1, 2005 in
													Japan. One of the responses to this law enforcement is demanding a higher level
													of information risk management and search for more effective tools to be used for
													identity protection and problem-solving. Two examples of these tools include
													RAPID and IRMP. However, there is no established system-development model
													for either of these tools. Further developments to improve the RAPID and IRMP
													remain as new challenges. In this thesis, a new approach on developing a system
													security model to be used for information risk management is proposed. To
													demonstrate this approach, the object-oriented language is used.</p> --}}
													<br>
													<p id="QRCode">{!! QrCode::size(300)->generate('http://'.Request::server('SERVER_NAME').'/pdf.js/web/viewer.html?file=http://'.Request::server('SERVER_NAME').$file->FilePath); !!}</p>
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