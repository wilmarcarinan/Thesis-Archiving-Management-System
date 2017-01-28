@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="/css/style.css">
@endsection

@section('content')
<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading"><h2>Latest</h2></div>
    <div class="panel-body container">
      <div class="w3-card-4 col-md-3 col-md-offset-1 col-sm-4 col-sm-offset-1 col-xs-12" style="padding: 50px 25px;">
        <div class="w3-container">
          <h4><center><b>Thesis Title paano kung masyadong mahaba?</b></center></h4><br /><br /><br />
          <p><b>Author/s</b></p> 
          <p>Date</p>
        </div>
        <center class="w3-container" style="padding: 10px">
          <span class="glyphicon glyphicon-eye-open">100</span>
          <span class="glyphicon glyphicon-star-empty">100</span>
          <br />
        </center>
      </div>
      <div class="col-md-1 col-sm-1">
      </div>
      <div class="col-md-5 col-sm-5">
        <h1>Thesis Title</h1>
        <p style="height: 7.5em; overflow: hidden;">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
        </p>
        <button type="button" class="btn btn-info col-sm-offset-1 col-xs-offset-3">View more</button>
      </div>
    </div>
    <div class="panel-footer">
    </div>
  </div>
<div class="container">
  <ul class="nav nav-pills">
    <li class="active"><a data-toggle="tab" href="#latest">Latest</a></li>
    <li><a data-toggle="tab" href="#suggested">Suggested</a></li>
    <li><a data-toggle="tab" href="#mostviewed">Most Viewed</a></li>
  </ul>
  <div class="tab-content">
    <div id="latest" class="tab-pane fade in active">
      <div class="container">
        <h2>Latest</h2>
        <div class="table-responsive">          
          <table class="table">
            <thead>
              <tr>
                <th><span class="glyphicon glyphicon-sort-by-order"></span></th>
                <th>Title</th>
                <th>Date</th>
                <th>Adviser</th>
                <th>Course</th>
                <th><span class="glyphicon glyphicon-eye-open"></span></th>
                <th><span class="glyphicon glyphicon-star-empty"></span></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        <br />
        </div>
        <center>
          <button type="button" class="btn btn-info">View more</button>
        </center>
      </div>
    </div>
    <div id="suggested" class="tab-pane fade">
      <div class="container">
        <h2>Suggested</h2>                                                                                 
        <div class="table-responsive">          
          <table class="table">
            <thead>
              <tr>
                <th><span class="glyphicon glyphicon-sort-by-order"></span></th>
                <th>Title</th>
                <th>Date</th>
                <th>Adviser</th>
                <th>Course</th>
                <th><span class="glyphicon glyphicon-eye-open"></span></th>
                <th><span class="glyphicon glyphicon-star-empty"></span></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            </table>
          <br />
          <center>
            <button type="button" class="btn btn-info">View more</button>
          </center>
        </div>
      </div>
    </div>
    <div id="mostviewed" class="tab-pane fade">
      <div class="container">
        <h2>Most Viewed</h2>                                                                        
        <div class="table-responsive">          
          <table class="table">
            <thead>
              <tr>
                <th><span class="glyphicon glyphicon-sort-by-order"></span></th>
                <th>Title</th>
                <th>Date</th>
                <th>Adviser</th>
                <th>Course</th>
                <th><span class="glyphicon glyphicon-eye-open"></span></th>
                <th><span class="glyphicon glyphicon-star-empty"></span></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          <br />
          <center>
            <button type="button" class="btn btn-info">View more</button>
          </center>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('footer')

@endsection