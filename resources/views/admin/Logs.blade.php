@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12 jumbotron">
				<h2>Activity Logs</h2>
				<table class="table" id="logs-table">
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
							<td>{{ $log->created_at->toDayDateTimeString() }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				{{-- @if(!$logs->count())
	                <center>
	                    <h3>No Logs</h3>
	                </center>
	            @endif --}}
				{{-- {{ $logs->links() }} --}}
			</div>
		</div>
	</div>
@endsection

@section('script-section')
    <script>
        $(document).ready(function(){
            $('#logs-table').DataTable({
                responsive: true
            });
        });
    </script>
@endsection