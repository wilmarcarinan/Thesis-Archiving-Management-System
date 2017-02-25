@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>Add File Form</h4>
					</div>
					<div class="panel-body">
						<form action="/AddFile" class="form-horizontal" method="POST" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="form-group">
								<label for="FileTitle" class="col-md-4 control-label">Thesis Title: </label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="FileTitle">
								</div>
							</div>

							<div class="form-group">
								<label for="Categories" class="col-md-4 control-label">Categories: </label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="Category">
								</div>
							</div>
							
							<div class="form-group">
								<label for="Abstract" class="col-md-4 control-label">Abstract: </label>
								<div class="col-md-6">
									<textarea class="form-control" name="Abstract" rows="9">
									</textarea>
								</div>
							</div>

							<div class="form-group">
								<label for="Authors" class="col-md-4 control-label">Authors: </label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="Authors">
								</div>
							</div>

							<div class="form-group">
								<label for="Course" class="col-md-4 control-label">Course: </label>
								<div class="col-md-6">
									<select class="form-control" name="Course">
										<option value="">Select Course</option>
										{{-- @foreach($courses as $course)
											<option value="{{$course->Course}}">{{$course->Course}}</option>
										@endforeach --}}
										<option value="BSIT">BSIT</option>
										<option value="BSIS">BSIS</option>
										<option value="BSCS">BSCS</option>
									</select>
								</div>
							</div>							
							
							<div class="form-group">
								<label for="Adviser" class="col-md-4 control-label">Adviser: </label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="Adviser">
								</div>
							</div>

							<div class="form-group">
								<label for="thesis_date" class="col-md-4 control-label">Thesis Date: </label>
								<div class="col-md-6">
									<input type="date" class="form-control" name="thesis_date" placeholder="yyyy-mm-dd (e.g 2017-02-21)">
								</div>
							</div>
							
							<div class="form-group">
								<label for="FilePath" class="col-md-4 control-label">Thesis Name: </label>
								<div class="col-md-6">
									<input type="file" class="form-control" name="FilePath" accept="application/pdf">
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-8 col-md-offset-4">
									<button class="btn btn-primary" type="submit">
										Submit
									</button>
								</div>
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