@extends('layouts.app')

@section('content')
@if(Auth::user()->Role == 'User')
	<div class="container jumbotron" style="margin-top:50px">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			<h2 class="col-md-11 col-sm-10 col-xs-10">Search</h2>
			<button type="button" class="btn btn-info col-md-1 col-sm-2 col-xs-2" data-toggle="collapse" data-target="#advance">
					<span class="glyphicon glyphicon-filter"></span>
			</button>
			<form method="POST" action="/results">
				{{ csrf_field() }}
				<!--textbox-->
				<div class="input-group col-sm-12" style="padding: 20px 0;">
					<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
					<input id="search" type="text" class="form-control" name="search" placeholder="Type Thesis Name" autofocus>
				</div>
  				<div id="advance" class="collapse">
				<!--checkbox-->
				<div class="col-md-2 col-sm-0 col-xs-1"></div>
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
@else
	<div class="container jumbotron" style="margin-top:50px; margin-right: 120px">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			<h2 class="col-md-11 col-sm-10 col-xs-10">Search</h2>
			<button type="button" class="btn btn-info col-md-1 col-sm-2 col-xs-2" data-toggle="collapse" data-target="#advance">
					<span class="glyphicon glyphicon-filter"></span>
			</button>
			<form method="POST" action="/results">
				{{ csrf_field() }}
				<!--textbox-->
				<div class="input-group col-sm-12" style="padding: 20px 0;">
					<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
					<input id="search" type="text" class="form-control" name="search" placeholder="Search" autofocus>
				</div>
				<!--checkbox-->
				<div class="col-md-2 col-sm-0 col-xs-1"></div>
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
@endif
@endsection