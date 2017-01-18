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
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection