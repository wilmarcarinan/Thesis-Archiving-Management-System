@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="/css/style.css">
@stop

@section('content')
{{-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="img/up.jpg" alt="Files" class="sizeimage">
      <div class="carousel-caption carotextborder">
        <h3>Search a projects or lessons.</h3>
        <p>Easily search the reference or the study you want.</p>
        <p>And also will help you to review your previous lesson.</p>
      </div>
    </div>

    <div class="item">
      <img src="img/iceage.jpg" alt="Codes" class="sizeimage">
      <div class="carousel-caption carotextborder">
        <h3>Compile your works here.</h3>
        <p>You can attach your finish programs or systems</p>
        <p>If you want, so, other student can visit your works.</p>
      </div>
    </div>

    <div class="item">
      <img src="img/2.jpg" alt="Groups" class="sizeimage">
      <div class="carousel-caption carotextborder">
        <h3>Anyone can use our website.</h3>
        <p>All of your groupmates can access your projects.</p>
        <p>Every student can submit their files.</p>
      </div>
    </div>

    <div class="item">
      <img src="img/birds.jpg" alt="Hardware" class="sizeimage">
      <div class="carousel-caption carotextborder">
        <h3>Store your all of your Documents.</h3>
        <p>Even it is a hardware. You can still store all of your data.</p>
        <p>It will set as a back-up file of your works.</p>
      </div>
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev" title="back to previous">
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next" title="go to next">
  </a>
</div>

<div class="container-fluid text-center">

  <div class="row content">
    <div class="col-sm-2 sidenav">
      <p><a href="#">Sample Format</a></p>
      <p><a href="#">Thesis</a></p>
    </div>
    <div class="col-sm-8 text-left">
      <h1>Thesis Archiving Management System</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      <hr>
      <h3>Body</h3>
      <div class="col-sm-4">
        <img src="img/1.jpeg" alt="sample" height="100%" width="100%">
      </div>
      <div class="col-sm-8">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      </div>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      <marquee>Lorem ipsum dolor sit amet...</marquee>
     </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        <h3>Latest News</h3>
        <hr />
        <i>October 07, 2016</i>
        <br />
        <br />
        <p>Thesis Archiving Management...</p>
      </div>
      {{-- <div class="well">
        <h3>News</h3>
        <hr />
        <i>October 01, 2016</i>
        <br />
        <br />
        <p>Lesson Archiving Management...</p>
      </div> --}}
    </div>
  </div>
</div>
@endsection
@section('footer')
<footer class="container-fluid text-center">
  <p>Copyright &copy; 2016.</p>
</footer>
@stop