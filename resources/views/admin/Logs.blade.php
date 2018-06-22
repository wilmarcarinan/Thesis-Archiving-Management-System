@extends('layouts.app')

@section('content')
	<div class="container">
		@if(session('status'))
            <div class="alert alert-success" style="margin: 20px 0px 15px 0px">
                <li style="list-style: none">{{session('status')}}</li>
            </div>
        @endif
		<div class="row">
			<div class="col-md-12 jumbotron">
				<h2>Activity Logs</h2>
				<table class="table" id="logs-table" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Subject</th>
							<th>Details</th>
							<th>Date/Time</th>
							<th class="hidden"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($logs as $log)
						<tr>
							<td>{{ $log->Subject }}</td>
							<td>{{ $log->Details }}</td>
							<td>{{ $log->created_at->toDayDateTimeString() }}</td>
							<td class="hidden">{{$log->created_at}}</td>
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
                responsive: true,
                order: ['4','desc']
            });
        });
    </script>
@endsection