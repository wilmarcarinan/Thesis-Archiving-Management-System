@extends('layouts.app')

@section('content')
	<div class="container">
		@if(session('status'))
			<div class="alert alert-success" style="margin: 20px 0px -30px 0px">
				<li style="list-style: none">{{session('status')}}</li>
			</div>
		@endif
	</div>
@if(Auth::user()->Role == 'User')
	<div class="container jumbotron" style="margin-top: 100px">
@else
	<div style="padding-top: 100px">
	<div class="container jumbotron">
@endif
		<div class="col-sm-3"></div>
			<div class="col-sm-6">
				{{-- @if(session('status'))
					<div class="alert alert-danger">
						<li>{{session('status')}}</li>
					</div>
				@endif --}}
				<h2 class="col-md-11 col-sm-10 col-xs-10">Search</h2>
				<button type="button" class="btn btn-info col-md-1 col-sm-2 col-xs-2" data-toggle="collapse" data-target="#advance" title="Advance Search">
						<span class="glyphicon glyphicon-filter"></span>
				</button>
				<form method="POST" action="/results">
					{{ csrf_field() }}
					<!--textbox-->
					<div class="input-group col-sm-12" style="padding: 20px 0;">
						<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
						<input id="search" type="text" class="form-control" name="search" placeholder="Enter keywords (e.g Title, Abstract, Categories)" autofocus>
					</div>
	  				<div id="advance" class="collapse">
						<!--checkbox-->
						{{-- <div class="col-md-2 col-sm-0 col-xs-1"></div>
						<div class="col-sm-4 col-xs-5">
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
						<div class="col-sm-4 col-xs-5">
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
						</div> --}}

						<!--select-->
						<div class="row">
							<div class="form-group col-md-4">
								<select name="TableName1" id="TableName2" class="form-control">
									<option value="" disabled selected>Select Field</option>
									<option value="FileTitle">Title</option>
									<option value="Abstract">Abstract</option>
									<option value="SubjectArea">Subject Area</option>
									<option value="tag_name">Tags</option>
									<option value="Authors">Authors</option>
									<option value="Course">Course</option>
									<option value="Adviser">Adviser</option>
									<option value="thesis_date">Thesis Date</option>
								</select>
							</div>

							<div class="form-group col-md-4">
								<select name="Operator" id="Operator" class="form-control">
									<option value="">Select Operator</option>
									<option value="And">And</option>
									<option value="Or">Or</option>
								</select>
							</div>

							<div class="form-group col-md-4">
								<select name="TableName2" id="TableName2" class="form-control">
									<option value="" disabled selected>Select Field</option>
									<option value="FileTitle">Title</option>
									<option value="Abstract">Abstract</option>
									<option value="SubjectArea">Subject Area</option>
									<option value="tag_name">Tags</option>
									<option value="Authors">Authors</option>
									<option value="Course">Course</option>
									<option value="Adviser">Adviser</option>
									<option value="thesis_date">Thesis Date</option>
								</select>
							</div>
						</div>

						<div class="row">
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="Field1" id="Field1" placeholder="Enter keywords for Field 1">
							</div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="Field2" id="Field2" placeholder="Enter keywords for Field 2">
							</div>
						</div>
						
						{{-- <div class="row">
							<div class="form-group col-sm-8 col-xs-7">
								<label for="sel1">Adviser:</label>
								<select class="form-control" name="Adviser">
									<option value="">Select Adviser</option>
									@foreach($advisers as $adviser)
										@if($adviser->Adviser <> '')
											<option>{{$adviser->Adviser}}</option>
										@endif
									@endforeach
								</select>
							</div>
							<div class="form-group col-sm-4 col-xs-5">
								<label for="sel2">Date:</label>
								<select class="form-control" name="Year">
									<option value="">Select Year</option>
									@foreach($years as $year)
										<option value="{{$year['YEAR(thesis_date)']}}">{{$year['YEAR(thesis_date)']}}</option>
									@endforeach
								</select>
							</div>
						</div> --}}
						
					</div>
					<div class="col-sm-4 col-xs-3"></div>
					<div class="col-sm-8 col-xs-9">
						<button type="submit" class="btn btn-primary center">Submit</button>
						<button type="reset" class="btn btn-default center">Reset</button>
					</div>
					{{-- @if(count($errors) > 0)
						<div class="alert alert-danger" style="margin-top:50px;">
							<ul>
								@foreach($errors->all() as $error)
									<li style="list-style: none">{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif --}}
				</form>
			</div>
		</div>
		@if(session('SearchStatus'))
			<div class="container alert alert-danger">
				<li style="list-style: none">{{session('SearchStatus')}}</li>
			</div>
		@endif
	</div>
	<div class="col-sm-3">
	</div>
	</div>
@endsection