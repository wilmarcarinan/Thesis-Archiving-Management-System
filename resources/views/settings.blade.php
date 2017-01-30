@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>My Account</h4>
					</div>
					<div class="panel-body">
						<form action="/settings" method="POST" class="form">
							{{ csrf_field() }}
							{{ method_field('PATCH') }}

							<div class="form-group">
								<label for="StudentID">Student ID:</label>
								<input type="number" class="form-control" name="FirstName" id="StudentID" value="{{old('StudentID') ?? Auth::user()->StudentID}}" disabled>
							</div>

							<div class="form-group">
								<label for="FirstName">First Name:</label>
								<input type="text" class="form-control" name="FirstName" id="FirstName" value="{{old('FirstName') ?? Auth::user()->FirstName}}">
							</div>

							<div class="form-group">
								<label for="MiddleName">Middle Name:</label>
								<input type="text" class="form-control" name="MiddleName" id="MiddleName" value="{{old('MiddleName') ?? Auth::user()->MiddleName}}">
							</div>

							<div class="form-group">
								<label for="LastName">Last Name:</label>
								<input type="text" class="form-control" name="LastName" id="LastName" value="{{old('LastName') ?? Auth::user()->LastName}}">
							</div>

							<div class="form-group">
								<label for="Course">Course:</label>
								<input type="text" class="form-control" name="Course" id="Course" value="{{old('Course') ?? Auth::user()->Course}}">
							</div>

							<div class="form-group">
								<label for="College">College:</label>
								<input type="text" class="form-control" name="College" id="College" value="{{old('College') ?? Auth::user()->College}}">
							</div>

							<div class="form-group">
								<label for="email">Email:</label>
								<input type="email" class="form-control" name="email" id="email" value="{{old('email') ?? Auth::user()->email}}">
							</div>

							<div class="form-group">
								<label for="CurrentPassword">Old Password:</label>
								<input type="password" class="form-control" name="CurrentPassword" id="CurrentPassword" value="{{old('password') ?? Auth::user()->password}}" disabled>
							</div>

							<div class="form-group">
								<label for="NewPassword">New Password:</label>
								<input type="password" class="form-control" name="NewPassword" id="NewPassword">
							</div>

							<div class="form-group">
								<label for="ConfirmNewPassword">Confirm New Password:</label>
								<input type="password" class="form-control" name="ConfirmNewPassword" id="ConfirmNewPassword">
							</div>

							<div class="form-group">
								<button class="btn btn-primary">Update Account</button>
							</div>

							@if(count($errors) > 0)
							<div class="alert alert-danger">
								<ul>
									@foreach($errors->all() as $error)
									<li>{{ $error }}</li>
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