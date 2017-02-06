@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-md-offset-1">
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
										<button class="btn btn-primary" type="submit">Unlock</button>
								@else
									<form action="/LockUser" method="POST">
										{{method_field('PATCH')}}
										{{csrf_field()}}
										<input type="hidden" name="user_id" value="{{$user->id}}">
										<button class="btn btn-primary" type="submit">Lock</button>
								@endif
									</form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{ $users->links() }}
				</div>
			</div>
		</div>
	</div>
@endsection