@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="table-responsive" id="FileTable">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Subject</th>
								<th>Details</th>
								<th>Date/Time</th>
							</tr>
						</thead>
						<tbody>
							@foreach($logs as $log)
							<tr>
								<td>{{ $log->Subject }}</td>
								<td>{{ $log->Details }}</td>
								<td>{{ $log->created_at }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{ $logs->links() }}
				</div>
			</div>
		</div>
	</div>
@endsection