@extends('layout')

@section('header')
<title>Mngt System | Home</title>
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<style>
    /* Remove the navbar's default margin-bottom and rounded borders */
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 150%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #000;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;}
    }
    .sizeimage {
  width: 100%;
  min-height: 225px;
  max-height: 480px;
}
    .carotextborder {
    font-family: helvetica;
    font-size: 10px;
    left: 10%;
    position: absolute;
    width: 25%;
    padding: 50 20px;
    color: #000;
    background-color: #fff;
    background-color: rgba(255,255,255, 0.5);
    border-radius: 4px;
    }
  </style>
@stop

@section('content')
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="http://www.gov.ph">
        <img alt="Brand" src="img/tup.png" height="25px" width="25px">
      </a>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">MNGT SYS.</a>
    </div>
    <div  class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <li><a href="#">Home</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Files <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#"><span class="glyphicon glyphicon-book left"></span> Thesis</a></li>
          <li><a href="#"><span class="glyphicon glyphicon-file left"></span> Lessons</a></li>
          <li><a href="#"><span class="glyphicon glyphicon-plus left"></span> Additional</a></li>
        </ul>
      </li>
      <li><a href="#">About Us</a></li>
      <li><a href="#">Contact Us</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-search"></span> Search</a></li>
    </ul>
  </div>
</nav>

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
      <p><a href="#">Lessons</a></p>
    </div>
    <div class="col-sm-8 text-left">
      <h1>Thesis and Lessons Archiving Management System</h1>
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
      <div class="well">
        <h3>News</h3>
        <hr />
        <i>October 01, 2016</i>
        <br />
        <br />
        <p>Lesson Archiving Management...</p>
      </div>
    </div>
  </div>
</div>
@stop

@section('footer')
<footer class="container-fluid text-center">
  <p>Copyright &copy; 2016.</p>
</footer>
@stop