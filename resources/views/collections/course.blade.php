@extends('layouts.app')

@section('content')
	<div class="container">
		<h2 style="margin-bottom: 15px">
			<a href="/collections">/Collections/</a>{{$Course}}
		</h2>
		<div class="table-responsive">
			<table id="files-course" class="table" cellspacing="0" width="100%">
		        <thead>
		            <tr>
		                @if(Auth::user()->Role <> 'Admin')
		                <th></th>
		                <th></th>
		                <th></th>
	                    @endif
	                    <th>Title</th>
	                    <th class="hidden">Abstract</th>
	                    <th class="hidden">Author/s</th>
	                    <th class="hidden">Adviser</th>
	                    <th>Tags</th>
	                    <th>Course</th>
	                    <th>Thesis Date</th>
	                    @if(Auth::user()->Role == 'Admin')
	                    <th>Status</th>
	                    @endif
	                    <th><span class="glyphicon glyphicon-eye-open"></span></th>
	                    <th><span class="glyphicon glyphicon-star-empty"></span></th>
	                    @if(Auth::user()->Role == 'Admin')
	                    <th></th>
	                    <th></th>
	                    @endif
		            </tr>
		        </thead>
		        <tfoot>
		        	<tr>
		                @if(Auth::user()->Role <> 'Admin')
		                <th></th>
		                <th></th>
		                <th></th>
	                    @endif
	                    <th>Title</th>
	                    <th>Tags</th>
	                    {{-- <th>Author/s</th> --}}
	                    <th>Course</th>
	                    {{-- <th>Adviser</th> --}}
	                    <th>Thesis Date</th>
	                    @if(Auth::user()->Role == 'Admin')
	                    <th>Status</th>
	                    @endif
	                    <th><span class="glyphicon glyphicon-eye-open"></span></th>
	                    <th><span class="glyphicon glyphicon-star-empty"></span></th>
	                    @if(Auth::user()->Role == 'Admin')
	                    <th></th>
	                    <th></th>
	                    @endif
		            </tr>
		        </tfoot>
		        <tbody>
		        	@include('file.table-contents')
		        </tbody>
		    </table>
		</div>
	</div>
@endsection

@section('script-section')
	<script>
		$(document).ready(function(){
			$('#files-course').DataTable({
				responsive: true
			});
		});
	</script>
@endsection