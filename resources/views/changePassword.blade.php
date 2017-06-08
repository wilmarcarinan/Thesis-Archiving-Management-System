@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				@if(session('status'))
			        <div class="alert alert-success" style="margin: 20px 0px 15px 0px">
			            <li style="list-style: none">{{session('status')}}</li>
			        </div>
			    @endif
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>Change Password</h4>
					</div>
					<div class="panel-body">
						<form action="/changePassword" method="POST" class="form">
							{{ csrf_field() }}
							{{ method_field('PATCH') }}

							<div class="form-group">
								<label for="CurrentPassword">Old Password:</label>
								<input type="password" class="form-control" name="CurrentPassword" id="CurrentPassword">
							</div>

							<div class="form-group">
								<label for="NewPassword">New Password:</label>
								<input type="password" class="form-control" name="NewPassword" id="NewPassword">
							</div>

							<div class="form-group">
								<label for="ConfirmNewPassword">Confirm New Password:</label>
								<input type="password" class="form-control" name="NewPassword_confirmation" id="ConfirmNewPassword">
							</div>

							<div class="form-group">
								<button class="btn btn-primary">Update Account</button>
							</div>
							@if(session('ChangePasswordStatus'))
							<div class="alert alert-danger">
								<li>{{session('ChangePasswordStatus')}}</li>
							</div>
							@endif
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