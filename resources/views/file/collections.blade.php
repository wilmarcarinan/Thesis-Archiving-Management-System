@extends('layouts.app')

@section('content')
<div class="container">
	<div class="col-xs-12">
	    <div class="page-header">
	        <h3 style="padding: 15px 0px 0px 0px;">Categories</h3>
	    </div>
	   
	    <div class="category-title">
	    	<h4>Information Technology (IT)</h4>
	    </div>
	    @if($category1 <> '[]')
	    <div class="carousel slide" id="myCarousel">
		    <div class="carousel-inner">
		    	<!-- /Slide1 -->
		    	<div class="item active">
		    		<ul class="thumbnails">
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category1[0]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category1[0]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category1[0]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@if($category1->count() > 1)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category1[1]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category1[1]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category1[1]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    			@if($category1->count() > 2)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category1[2]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category1[2]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category1[2]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    			@if($category1->count() > 3)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category1[3]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category1[3]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category1[3]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    		</ul>
		    	</div> 

		    	@if($category1->count() > 4)
		    	<!-- /Slide2 --> 
		    	<div class="item">
		    		<ul class="thumbnails">
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category1[4]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category1[4]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category1[4]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@if($category1->count() > 5)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category1[5]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category1[5]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category1[5]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    			@if($category1->count() > 6)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category1[6]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category1[6]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category1[6]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    			@if($category1->count() > 7)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category1[7]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category1[7]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category1[7]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    		</ul>
		    	</div>
		    	@endif

		    	@if($category1->count() > 8)
		    	<!-- /Slide3 -->
		    	<div class="item">
		    		<ul class="thumbnails">
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category1[8]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category1[8]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category1[8]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@if($category1->count() > 9)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category1[9]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category1[9]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category1[9]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    			@if($category1->count() > 10)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category1[10]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category1[10]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category1[10]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    			@if($category1->count() > 11)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category1[11]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category1[11]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category1[11]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    		</ul>
		    	</div>
		    	@endif 
		    </div>
		    @if($category1->count() >= 4)
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
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category2[0]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category2[0]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category2[0]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@if($category2->count() > 1)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category1[1]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category2[1]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category1[1]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    			@if($category2->count() > 2)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category2[2]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category2[2]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category2[2]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    			@if($category2->count() > 3)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category2[3]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category2[3]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category2[3]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    		</ul>
		    	</div> 

		    	@if($category2->count() > 4)
		    	<!-- /Slide2 --> 
		    	<div class="item">
		    		<ul class="thumbnails">
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category2[4]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category2[4]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category2[4]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@if($category2->count() > 5)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category2[5]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category2[5]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category2[5]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    			@if($category2->count() > 6)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category2[6]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category2[6]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category2[6]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    			@if($category2->count() > 7)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category2[7]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category2[7]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category2[7]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    		</ul>
		    	</div>
		    	@endif

		    	@if($category2->count() > 8)
		    	<!-- /Slide3 -->
		    	<div class="item">
		    		<ul class="thumbnails">
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category2[8]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category2[8]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category2[8]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@if($category2->count() > 9)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category2[9]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category2[9]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category2[9]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    			@if($category2->count() > 10)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category2[10]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category2[10]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category2[10]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    			@if($category2->count() > 11)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category2[11]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category2[11]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category2[11]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    		</ul>
		    	</div>
		    	@endif 
		    </div>
		    @if($category2->count() >= 4)
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
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category3[0]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category3[0]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category3[0]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@if($category3->count() > 1)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category3[1]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category3[1]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category3[1]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    			@if($category3->count() > 2)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category3[2]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category3[2]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category3[2]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    			@if($category3->count() > 3)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category3[3]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category3[3]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category3[3]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    		</ul>
		    	</div> 

		    	@if($category3->count() > 4)
		    	<!-- /Slide2 --> 
		    	<div class="item">
		    		<ul class="thumbnails">
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category3[4]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category3[4]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category3[4]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@if($category3->count() > 5)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category3[5]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category3[5]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category3[5]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    			@if($category3->count() > 6)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category3[6]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category3[6]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category3[6]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    			@if($category3->count() > 7)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category3[7]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category3[7]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category3[7]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    		</ul>
		    	</div>
		    	@endif

		    	@if($category3->count() > 8)
		    	<!-- /Slide3 -->
		    	<div class="item">
		    		<ul class="thumbnails">
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category3[8]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category3[8]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category3[8]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@if($category3->count() > 9)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category3[9]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category3[9]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category3[9]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    			@if($category3->count() > 10)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category3[10]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category3[10]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category3[10]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    			@if($category3->count() > 11)
		    			<li class="col-sm-3">
		    				<div class="fff">
		    					<div class="thumbnail">
		    						<a href="#"><img src="../../img/IT.jpg" alt=""></a>
		    					</div>
		    					<div class="caption">
		    						<h4>"{{$category3[11]->FileTitle}}"</h4>
		    						<p>{{\Illuminate\Support\Str::words($category3[11]->Abstract, $words = 20, $end = '...')}}</p>
		    						<a class="btn btn-mini" href="{{$category3[11]->FilePath}}">» Read More</a>
		    					</div>
		    				</div>
		    			</li>
		    			@endif
		    		</ul>
		    	</div>
		    	@endif 
		    </div>
		    @if($category3->count() >= 4)
		    <!--Control Box-->
		    <nav>
		    	<ul class="control-box pager">
		    		<li><a data-slide="prev" href="#myCarousel2" class=""><i class="glyphicon glyphicon-chevron-left"></i></a></li>
		    		<li><a data-slide="next" href="#myCarousel2" class=""><i class="glyphicon glyphicon-chevron-right"></i></li>
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