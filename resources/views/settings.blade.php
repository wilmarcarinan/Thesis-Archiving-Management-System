@extends('layouts.app')

@section('content')
	<div class="container" style="padding-top: 70px;">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading" style="background-color: #64b5f6;">
						<h4 class="col-sm-9 col-xs-7" style="color: #fff;">My Account</h4>
						<p style="color: #ddd; padding-top: 5px;">ID: {{old('StudentID') ?? Auth::user()->StudentID}}</p>
					</div>
					<div class="panel-body">
						<form action="/settings" method="POST" class="form">
							{{ csrf_field() }}
							{{ method_field('PATCH') }}

							<!-- <div class="form-group">
								<label for="StudentID">Student ID:</label>
								<input type="number" class="form-control" name="FirstName" id="StudentID" value="" disabled>
							</div> -->

							<div class="form-group">
								<label for="FirstName">First Name:</label>
								<input type="text" class="form-control" name="FirstName" id="FirstName" value="{{old('FirstName') ?? Auth::user()->FirstName}}">
							</div><br />

							<div class="form-group">
								<label for="MiddleName">Middle Name:</label>
								<input type="text" class="form-control" name="MiddleName" id="MiddleName" value="{{old('MiddleName') ?? Auth::user()->MiddleName}}">
							</div><br />

							<div class="form-group">
								<label for="LastName">Last Name:</label>
								<input type="text" class="form-control" name="LastName" id="LastName" value="{{old('LastName') ?? Auth::user()->LastName}}">
							</div><br />

							<div class="form-group">
								<label for="Course">Course:</label>
								<select class="form-control" name="Course">
                                    <!-- <option value="{{ Auth::user()->Course }}">{{ Auth::user()->Course }}</option>
                                    {{-- @foreach($courses as $course)
                                        <option value="{{$course->Course}}">{{$course->Course}}</option>
                                    @endforeach --}} -->
                                    <option value="BSIT">BSIT</option>
                                    <option value="BSIS">BSIS</option>
                                    <option value="BSCS">BSCS</option>
                                </select>
							</div>

							<div class="form-group">
								<label for="College">College:</label>
								<input type="text" class="form-control" name="College" id="College" value="{{old('College') ?? Auth::user()->College}}">
							</div><br />

							<div class="form-group">
								<label for="email">Email:</label>
								<input type="email" class="form-control" name="email" id="email" value="{{old('email') ?? Auth::user()->email}}">
							</div><br/>

							<div class="form-group">
								<center><button class="btn btn-primary">Update Account</button></center>
							</div>

							@if(count($errors) > 0)
							<div class="alert alert-danger">
								<ul>
									@foreach($errors->all() as $error)
										<li style="list-style: none;">{{ $error }}</li>
									@endforeach
								</ul>
							</div>
							@endif
						</form>
					</div>
				</div>
			</div>	
		</div>
	</div>
@endsection