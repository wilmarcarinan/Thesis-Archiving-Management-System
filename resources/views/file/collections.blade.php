@extends('layouts.app')

@section('content')
<div class="container">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#recent">Recent</a></li>
    <li><a data-toggle="tab" href="#favorites">Favorites</a></li>
    <li><a data-toggle="tab" href="#toread">To-read</a></li>
  </ul>
  <div class="tab-content">
    <div id="recent" class="tab-pane fade in active">
      <div class="container">
        <h2><span class="glyphicon glyphicon-time"></span> Recent</h2>
        <div class="table-responsive">          
          <table class="table">
            <thead>
              <tr>
                <th><span class="glyphicon glyphicon-sort-by-order"></span></th>
                <th>Title</th>
                
                <th>Adviser</th>
                <th>Course</th>
                <th>Thesis Date</th>
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
    <div id="favorites" class="tab-pane fade">
      <div class="container">
        <h2><span class="glyphicon glyphicon-star-empty"></span> Favorites</h2>                                                                    
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
    <div id="toread" class="tab-pane fade">
      <div class="container">
        <h2><span class="glyphicon glyphicon-ok-circle"></span> To-Read</h2>                                                                        
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
</div>	<div class="container">

@endsection