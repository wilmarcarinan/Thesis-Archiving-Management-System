@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 70px">
	<div class="col-xs-12">
	    {{-- <div class="page-header">
	        <h3 style="padding: 15px 0px 0px 0px;">Categories</h3>
	    </div> --}}
	   
	    <div class="category-title">
	    	<h4>Information Technology (IT)</h4>
	    </div>
	    @if($category1 <> '[]')
	    <div class="carousel slide" id="myCarousel">
		    <div class="carousel-inner">
		    	<!-- /Slide1 -->
		    	<div class="item active">
		    		<ul class="thumbnails">
		    			@foreach($category1->slice(0,4) as $category)
							<li class="col-sm-3">
								<div class="thumbnail">
									<a href="#"><img src="../../img/IT.jpg" alt=""></a>
								</div>
								<div class="caption">
									{{-- <p>{{$loop->iteration}}</p> --}}
		    						<h4>"{{$category->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category->Abstract, $words = 20, $end = '...')}}</p>
		    						@if(Request::server('SERVER_NAME') <> '127.0.0.1')
			    						<a href="http://{{Request::server('SERVER_NAME')}}/pdf.js/web/viewer.html?file=http://{{Request::server('SERVER_NAME')}}/files/{{$category->FilePath}}" target="_blank">» Read More</a>
		    						@else
			    						<a href="http://localhost:8000/pdf.js/web/viewer.html?file=http://{{Request::server('SERVER_NAME')}}/files/{{$category->FilePath}}" target="_blank" class="btn btn-mini">» Read More</a>
		    						@endif
		    						{{-- <a class="btn btn-mini" href="{{$category->FilePath}}"></a> --}}
		    					</div>
							</li>
		    			@endforeach
		    		</ul>
		    	</div> 

		    	@if($category1->count() > 4)
		    	<!-- /Slide2 --> 
		    	<div class="item">
		    		<ul class="thumbnails">
		    			@foreach($category1->slice(4,4) as $category)
			    			<li class="col-sm-3">
			    				<div class="fff">
			    					<div class="thumbnail">
			    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
			    					</div>
			    					<div class="caption">
			    						<h4>"{{$category->FileTitle}}"</h4>
			    						<p>{{\Illuminate\Support\Str::words($category->Abstract, $words = 20, $end = '...')}}</p>
			    						@if(Request::server('SERVER_NAME') <> '127.0.0.1')
				    						<a href="http://{{Request::server('SERVER_NAME')}}/pdf.js/web/viewer.html?file=http://{{Request::server('SERVER_NAME')}}/files/{{$category->FilePath}}" target="_blank">» Read More</a>
			    						@else
				    						<a href="http://localhost:8000/pdf.js/web/viewer.html?file=http://{{Request::server('SERVER_NAME')}}/files/{{$category->FilePath}}" target="_blank" class="btn btn-mini">» Read More</a>
			    						@endif
			    					</div>
			    				</div>
			    			</li>
			    		@endforeach
		    		</ul>
		    	</div>
		    	@endif

		    	@if($category1->count() > 8)
		    	<!-- /Slide3 -->
		    	<div class="item">
		    		<ul class="thumbnails">
		    			@foreach($category1->slice(8,4) as $category)
			    			<li class="col-sm-3">
			    				<div class="fff">
			    					<div class="thumbnail">
			    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
			    					</div>
			    					<div class="caption">
			    						<h4>"{{$category->FileTitle}}"</h4>
			    						<p>{{\Illuminate\Support\Str::words($category->Abstract, $words = 20, $end = '...')}}</p>
			    						@if(Request::server('SERVER_NAME') <> '127.0.0.1')
				    						<a href="http://{{Request::server('SERVER_NAME')}}/pdf.js/web/viewer.html?file=http://{{Request::server('SERVER_NAME')}}/files/{{$category->FilePath}}" target="_blank">» Read More</a>
			    						@else
				    						<a href="http://localhost:8000/pdf.js/web/viewer.html?file=http://{{Request::server('SERVER_NAME')}}/files/{{$category->FilePath}}" target="_blank" class="btn btn-mini">» Read More</a>
			    						@endif
			    					</div>
			    				</div>
			    			</li>
			    		@endforeach
		    		</ul>
		    	</div>
		    	@endif 
		    </div>
		    @if($category1->count() > 4)
		    <nav>
		    	<ul class="control-box pager">
		    		<li><a data-slide="prev" href="#myCarousel" class=""><i class="glyphicon glyphicon-chevron-left"></i></a></li>
		    		<li><a data-slide="next" href="#myCarousel" class=""><i class="glyphicon glyphicon-chevron-right"></i></li>
		    	</ul>
		    </nav>
		    @endif
			<!-- /.control-box -->                          
	    </div><!-- /#myCarousel -->
		@endif


		<!-- #myCarousel2 -->
	    <div class="category-title">
	    	<h4>Information System (IS)</h4>
	    </div>
	    @if($category2 <> '[]')
	    <div class="carousel slide" id="myCarousel2">
		    <div class="carousel-inner">
		    	<!-- /Slide1 -->
		    	<div class="item active">
		    		<ul class="thumbnails">
		    			@foreach($category2->slice(0,4) as $category)
			    			<li class="col-sm-3">
			    				<div class="fff">
			    					<div class="thumbnail">
			    						<a href="#"><img src="../../img/IS.jpg" alt=""></a>
			    					</div>
			    					<div class="caption">
			    						<h4>"{{$category->FileTitle}}"</h4>
			    						<p>{{\Illuminate\Support\Str::words($category->Abstract, $words = 20, $end = '...')}}</p>
			    						@if(Request::server('SERVER_NAME') <> '127.0.0.1')
				    						<a href="http://{{Request::server('SERVER_NAME')}}/pdf.js/web/viewer.html?file=http://{{Request::server('SERVER_NAME')}}/files/{{$category->FilePath}}" target="_blank">» Read More</a>
			    						@else
				    						<a href="http://localhost:8000/pdf.js/web/viewer.html?file=http://{{Request::server('SERVER_NAME')}}/files/{{$category->FilePath}}" target="_blank" class="btn btn-mini">» Read More</a>
			    						@endif
			    					</div>
			    				</div>
			    			</li>
			    		@endforeach
		    		</ul>
		    	</div> 

		    	@if($category2->count() > 4)
		    	<!-- /Slide2 --> 
		    	<div class="item">
		    		<ul class="thumbnails">
		    			@foreach($category2->slice(4,4) as $category)
			    			<li class="col-sm-3">
			    				<div class="fff">
			    					<div class="thumbnail">
			    						<a href="#"><img src="../../img/IS.jpg" alt=""></a>
			    					</div>
			    					<div class="caption">
			    						<h4>"{{$category->FileTitle}}"</h4>
			    						<p>{{\Illuminate\Support\Str::words($category->Abstract, $words = 20, $end = '...')}}</p>
			    						@if(Request::server('SERVER_NAME') <> '127.0.0.1')
				    						<a href="http://{{Request::server('SERVER_NAME')}}/pdf.js/web/viewer.html?file=http://{{Request::server('SERVER_NAME')}}/files/{{$category->FilePath}}" target="_blank">» Read More</a>
			    						@else
				    						<a href="http://localhost:8000/pdf.js/web/viewer.html?file=http://{{Request::server('SERVER_NAME')}}/files/{{$category->FilePath}}" target="_blank" class="btn btn-mini">» Read More</a>
			    						@endif
			    					</div>
			    				</div>
			    			</li>
			    		@endforeach
		    		</ul>
		    	</div>
		    	@endif

		    	@if($category2->count() > 8)
		    	<!-- /Slide3 -->
		    	<div class="item">
		    		<ul class="thumbnails">
		    			@foreach($category2->slice(8,4) as $category)
			    			<li class="col-sm-3">
			    				<div class="fff">
			    					<div class="thumbnail">
			    						<a href="#"><img src="../../img/IS.jpg" alt=""></a>
			    					</div>
			    					<div class="caption">
			    						<h4>"{{$category->FileTitle}}"</h4>
			    						<p>{{\Illuminate\Support\Str::words($category->Abstract, $words = 20, $end = '...')}}</p>
			    						@if(Request::server('SERVER_NAME') <> '127.0.0.1')
				    						<a href="http://{{Request::server('SERVER_NAME')}}/pdf.js/web/viewer.html?file=http://{{Request::server('SERVER_NAME')}}/files/{{$category->FilePath}}" target="_blank">» Read More</a>
			    						@else
				    						<a href="http://localhost:8000/pdf.js/web/viewer.html?file=http://{{Request::server('SERVER_NAME')}}/files/{{$category->FilePath}}" target="_blank" class="btn btn-mini">» Read More</a>
			    						@endif
			    					</div>
			    				</div>
			    			</li>
			    		@endforeach
		    		</ul>
		    	</div>
		    	@endif 
		    </div>
		    @if($category2->count() > 4)
		    <nav>
		    	<ul class="control-box pager">
		    		<li><a data-slide="prev" href="#myCarousel2" class=""><i class="glyphicon glyphicon-chevron-left"></i></a></li>
		    		<li><a data-slide="next" href="#myCarousel2" class=""><i class="glyphicon glyphicon-chevron-right"></i></li>
		    	</ul>
		    </nav>
		    <!-- /.control-box -->
		    @endif
	    </div><!-- /#myCarousel2 -->
		@endif

		<!-- #myCarousel3 -->
		<div class="category-title">
	    	<h4>Computer Science (CS)</h4>
	    </div>
	    @if($category3 <> '[]')
	    <div class="carousel slide" id="myCarousel2">
		    <div class="carousel-inner">
		    	<!-- /Slide1 -->
		    	<div class="item active">
		    		<ul class="thumbnails">
		    			@foreach($category3->slice(0,4) as $category)
			    			<li class="col-sm-3">
			    				<div class="fff">
			    					<div class="thumbnail">
			    						<a href="#"><img src="../../img/CS.jpg" alt=""></a>
			    					</div>
			    					<div class="caption">
			    						<h4>"{{$category->FileTitle}}"</h4>
			    						<p>{{\Illuminate\Support\Str::words($category->Abstract, $words = 20, $end = '...')}}</p>
			    						@if(Request::server('SERVER_NAME') <> '127.0.0.1')
				    						<a href="http://{{Request::server('SERVER_NAME')}}/pdf.js/web/viewer.html?file=http://{{Request::server('SERVER_NAME')}}/files/{{$category->FilePath}}" target="_blank">» Read More</a>
			    						@else
				    						<a href="http://localhost:8000/pdf.js/web/viewer.html?file=http://{{Request::server('SERVER_NAME')}}/files/{{$category->FilePath}}" target="_blank" class="btn btn-mini">» Read More</a>
			    						@endif
			    					</div>
			    				</div>
			    			</li>
			    		@endforeach
		    		</ul>
		    	</div> 

		    	@if($category3->count() > 4)
		    	<!-- /Slide2 --> 
		    	<div class="item">
		    		<ul class="thumbnails">
		    			@foreach($category3->slice(4,4) as $category)
			    			<li class="col-sm-3">
			    				<div class="fff">
			    					<div class="thumbnail">
			    						<a href="#"><img src="../../img/CS.jpg" alt=""></a>
			    					</div>
			    					<div class="caption">
			    						<h4>"{{$category->FileTitle}}"</h4>
			    						<p>{{\Illuminate\Support\Str::words($category->Abstract, $words = 20, $end = '...')}}</p>
			    						@if(Request::server('SERVER_NAME') <> '127.0.0.1')
				    						<a href="http://{{Request::server('SERVER_NAME')}}/pdf.js/web/viewer.html?file=http://{{Request::server('SERVER_NAME')}}/files/{{$category->FilePath}}" target="_blank">» Read More</a>
			    						@else
				    						<a href="http://localhost:8000/pdf.js/web/viewer.html?file=http://{{Request::server('SERVER_NAME')}}/files/{{$category->FilePath}}" target="_blank" class="btn btn-mini">» Read More</a>
			    						@endif
			    					</div>
			    				</div>
			    			</li>
			    		@endforeach
		    		</ul>
		    	</div>
		    	@endif

		    	@if($category3->count() > 8)
		    	<!-- /Slide3 -->
		    	<div class="item">
		    		<ul class="thumbnails">
		    			@foreach($category3->slice(8,4) as $category)
			    			<li class="col-sm-3">
			    				<div class="fff">
			    					<div class="thumbnail">
			    						<a href="#"><img src="../../img/CS.jpg" alt=""></a>
			    					</div>
			    					<div class="caption">
			    						<h4>"{{$category->FileTitle}}"</h4>
			    						<p>{{\Illuminate\Support\Str::words($category->Abstract, $words = 20, $end = '...')}}</p>
			    						@if(Request::server('SERVER_NAME') <> '127.0.0.1')
				    						<a href="http://{{Request::server('SERVER_NAME')}}/pdf.js/web/viewer.html?file=http://{{Request::server('SERVER_NAME')}}/files/{{$category->FilePath}}" target="_blank">» Read More</a>
			    						@else
				    						<a href="http://localhost:8000/pdf.js/web/viewer.html?file=http://{{Request::server('SERVER_NAME')}}/files/{{$category->FilePath}}" target="_blank" class="btn btn-mini">» Read More</a>
			    						@endif
			    					</div>
			    				</div>
			    			</li>
			    		@endforeach
		    		</ul>
		    	</div>
		    	@endif 
		    </div>
		    @if($category3->count() > 4)
		    <!--Control Box-->
		    <nav>
		    	<ul class="control-box pager">
		    		<li><a data-slide="prev" href="#myCarousel3" class=""><i class="glyphicon glyphicon-chevron-left"></i></a></li>
		    		<li><a data-slide="next" href="#myCarousel3" class=""><i class="glyphicon glyphicon-chevron-right"></i></li>
		    	</ul>
		    </nav>
		    <!-- /.control-box -->
		    @endif                          
	    </div>
	    <!-- /.myCarousel2 -->
		@endif
	</div>
	<!-- /.col-xs-12 -->
</div>
<!-- /.container -->
@endsection