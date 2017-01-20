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
									<input type="text" class="form-control" name="FileTitle" required autofocus>
								</div>
							</div>

							<div class="form-group">
								<label for="Categories" class="col-md-4 control-label">Categories: </label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="Category" required>
								</div>
							</div>
							
							<div class="form-group">
								<label for="Abstract" class="col-md-4 control-label">Abstract: </label>
								<div class="col-md-6">
									<textarea class="form-control" name="Abstract">
									</textarea>
								</div>
							</div>

							<div class="form-group">
								<label for="Authors" class="col-md-4 control-label">Authors: </label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="Authors" required>
								</div>
							</div>							
							
							<div class="form-group">
								<label for="Adviser" class="col-md-4 control-label">Adviser: </label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="Adviser" required>
								</div>
							</div>

							<div class="form-group">
								<label for="FilePath" class="col-md-4 control-label">Thesis Path: </label>
								<div class="col-md-6">
									<input type="file" class="form-control" name="FilePath" accept="application/pdf" required>
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