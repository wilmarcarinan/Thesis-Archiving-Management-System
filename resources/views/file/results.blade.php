@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			@if(Auth::user()->Role == 'Admin')
				<div class="col-md-11 col-md-offset-1">
			@else
				<div class="col-md-12">
			@endif
					@if($files == '[]')
						@if(Auth::user()->Role == 'Admin')
							<a href="/AddFile" class="btn btn-primary" id="AddFileBtn">Add Thesis</a>
						@endif
						<h3 style="margin-left:20px">Not Found</h3>
					@else
						@if(Auth::user()->Role == 'Admin')
							<a href="/AddFile" class="btn btn-primary" id="AddFileBtn">Add Thesis</a>
						@endif
						<div class="table-responsive" id="FileTable">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>No.</th>
										<th>Title</th>
										<th>Category</th>
										<th>Author/s</th>
										<th>Adviser</th>
										<th>Thesis Date</th>
										@if(Auth::user()->Role == 'Admin')
											<th>Status</th>
											<th></th>
										@endif
									</tr>
								</thead>
								<tbody>
									<?php $no=1; ?>
									<p class="QRCode hidden">
										@if(Request::server('SERVER_NAME') <> '127.0.0.1')
											<?php 
												$path='http://'.Request::server('SERVER_NAME').'/pdf.js/web/viewer.html?file=http://'.Request::server('SERVER_NAME');
												echo $path;
											?>
										@else
											<?php 
												$path='http://localhost:8000/pdf.js/web/viewer.html?file=http://localhost:8000';
												echo $path;
											?>
										@endif
										
									</p>
									@foreach($files as $file)
									<tr class="file">
										<td>{{$no++}}</td>
										<td>
											<!-- Button trigger modal -->
											<a class="btn viewInfo" data-toggle="modal" data-target="#myModal" data-title="{{$file->FileTitle}}" data-abstract="{{$file->Abstract}}" data-path="{{$file->FilePath}}">
												{{$file->FileTitle}}
											</a>
											{{-- <p class="fileAbstract"></p> --}}
											{{-- (Background statement) The spread of antibiotic resistance is aided by mobile elements such as transposons and conjugative plasmids. (Narrowing statement) Recently, integrons have been recognised as genetic elements that have the capacity to contribute to the spread of resistance. (Elaboration of narrowing) (statement) Integrons constitute an efficient means of capturing gene cassettes and allow expression of encoded resistance. (Aims) The aims of this study were to screen clinical isolates for integrons, characterise gene cassettes and extended spectrum b-lactamase (ESBL) genes.  (Extended aim) Subsequent to this, genetic linkage between ESBL genes and gentamicin resistance was investigated.  (Results) In this study, 41 % of multiple antibiotic resistant bacteria and 79 % of extended-spectrum b-lactamase producing organisms were found to carry either one or two integrons, as detected by PCR.  (Results)  A novel gene cassette contained within an integron was identified from Stenotrophomonas maltophilia, encoding a protein that belongs to the small multidrug resistance (SMR) family of transporters. (Results)  pLJ1, a transferable plasmid that was present in 86 % of the extended-spectrum b-lactamase producing collection, was found to harbour an integron carrying aadB, a gene cassette for gentamicin, kanamycin and tobramycin resistance and a blaSHV-12 gene for third generation cephalosporin resistance. (Justification of results) The presence of this plasmid accounts for the gentamicin resistance phenotype that is often associated with organisms displaying an extended-spectrum b-lactamase phenotype. --}}

											<!-- Modal -->
											<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															<h4 class="modal-title" id="myModalLabel"></h4>
															{{-- <label for="id-of-input" class="bookmark-checkbox">
																<input type="checkbox" id="bookmark"/>
																<i class="glyphicon glyphicon-bookmark"></i>
																<i class="glyphicon glyphicon-book"></i>
																<span></span>
															</label> --}}
															<label for="id-of-input" class="custom-checkbox">
																<input type="checkbox" id="favorites"/>
																<i class="glyphicon glyphicon-star-empty"></i>
																<i class="glyphicon glyphicon-star"></i>
																<span></span>
															</label>
															<style>
																label {
																	/* Presentation */
																	font-size: 48px
																}

																/* Required Styling */

																label input[type="checkbox"] {
																	display: none;
																}

																.custom-checkbox {
																	/*margin-left: 10em;*/
																	margin: -40px 20px 0px 0px; 
																	position: relative;
																	float: right;
																	cursor: pointer;
																}

																.custom-checkbox .glyphicon {
																	color: gold;
																	position: absolute;
																	top: 0.4em;
																	left: -1.25em;
																	font-size: 0.60em;
																}

																.custom-checkbox .glyphicon-star-empty {
																	color: gray;
																}

																.custom-checkbox .glyphicon-star {
																	opacity: 0;
																	transition: opacity 0.2s ease-in-out;
																}

																.custom-checkbox:hover .glyphicon-star{
																	opacity: 0.5;
																}

																.custom-checkbox input[type="checkbox"]:checked ~ .glyphicon-star {
																	opacity: 1;
																}
															</style>
														</div>
														<div class="modal-body">
															<p class="abstract"></p>
															<p>
																@if(Request::server('SERVER_NAME') <> '127.0.0.1')
																	<a href="/pdf.js/web/viewer.html?file=http://{{ Request::server('SERVER_NAME').$file->FilePath }}" target="_blank">
																@else
																	<a href="/pdf.js/web/viewer.html?file=http://localhost:8000{{$file->FilePath }}" target="_blank">
																@endif
																		{{ $file->FileTitle }}
																	</a>
															</p>
															<br>
															{{-- {!! QrCode::size(300)->generate('http://'.Request::server('SERVER_NAME').'/pdf.js/web/viewer.html?file=http://'.Request::server('SERVER_NAME').$file->FilePath) !!} --}}
															
															<p class="qrcodeCanvas" style="text-align: center;">
																	
															</p>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
											</div>
										</td>
										<td>{{$file->Category}}</td>
										<td>{{$file->Authors}}</td>
										<td>{{$file->Adviser}}</td>
										<td>{{ $file->thesis_date->format('F j, Y') }}</td>
										@if(Auth::user()->Role == 'Admin')
											<td>{{ $file->Status }}</td>
											<td>
												<a href="#" class="btn btn-primary btn-sm">Update</a>
											</td>
										@endif
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@endif
				</div>
		</div>
	</div>
@endsection