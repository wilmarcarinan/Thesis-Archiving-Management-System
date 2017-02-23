@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive" id="FileTable">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Student ID</th>
								<th>Name</th>
								<th>Course</th>
								<th>College</th>
								<th>Email</th>
								<th>Role</th>
								<th>Status</th>
								<th>Date Registered</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($users as $user)
							<tr>
								<td>{{ $user->StudentID }}</td>
								<td>{{ $user->FirstName }} {{ $user->MiddleName }} {{ $user->LastName }}</td>
								<td>{{ $user->Course }}</td>
								<td>{{ $user->College }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->Role }}</td>
								<td>{{ $user->Status }}</td>
								<td>{{ $user->created_at }}</td>
								<td>
								@if($user->Status == 'Inactive')
									<form action="/UnlockUser" method="POST">
										{{method_field('PATCH')}}
										{{csrf_field()}}
										<input type="hidden" name="user_id" value="{{$user->id}}">
										<button class="btn btn-primary fa fa-unlock-alt" type="submit" title="Unlock Acct"></button>
								@else
									<form action="/LockUser" method="POST">
										{{method_field('PATCH')}}
										{{csrf_field()}}
										<input type="hidden" name="user_id" value="{{$user->id}}">
										<button class="btn btn-primary fa fa-lock" type="submit" title="Lock Acct"></button>
								@endif
									</form>
								</td>
								<td>
								@if($user->Role == 'User')
									<form action="/PromoteUser" method="POST">
										{{method_field('PATCH')}}
										{{csrf_field()}}
										<input type="hidden" name="user_id2" value="{{$user->id}}">
										<button class="btn btn-primary fa fa-arrow-circle-up" type="submit" title="Promote User"></button>
								@else
									<form action="/DemoteUser" method="POST">
										{{method_field('PATCH')}}
										{{csrf_field()}}
										<input type="hidden" name="user_id2" value="{{$user->id}}">
										<button class="btn btn-primary fa fa-arrow-circle-down" type="submit" title="Demote User"></button>
								@endif
									</form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@if(!$users->count())
		                <center>
		                    <h3>No Users To Manage</h3>
		                </center>
		            @endif
					{{ $users->links() }}
				</div>
			</div>
		</div>
	</div>
@endsection