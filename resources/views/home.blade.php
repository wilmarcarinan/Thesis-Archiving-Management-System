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
          @if($latest_file <> '')
            <h4><center><b>{{$latest_file->FileTitle}}</b></center></h4><br /><br /><br />
            <p><b>{{$latest_file->Authors}}</b></p> 
            <p>{{$latest_file->thesis_date}}</p>
          @endif
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
        @if($latest_file <> '')
          <h1>{{$latest_file->FileTitle}}</h1>
          <p style="height: 7.5em; overflow: hidden;">{{$latest_file->Abstract}}</p>
          @if(Request::server('SERVER_NAME') <> '127.0.0.1')
            <a href="/pdf.js/web/viewer.html?file=http://{{ Request::server('SERVER_NAME').$latest_file->FilePath }}" target="_blank">
          @else
            <a href="/pdf.js/web/viewer.html?file=http://localhost:8000{{$latest_file->FilePath }}" target="_blank">
          @endif
              <button type="button" class="btn btn-info col-sm-offset-1 col-xs-offset-3" >View more</button>
            </a>
        @endif
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
                <th>Author/s</th>
                <th>Adviser</th>
                <th>Category</th>
                <th>Thesis Date</th>
                <th><span class="glyphicon glyphicon-eye-open"></span></th>
                <th><span class="glyphicon glyphicon-star-empty"></span></th>
              </tr>
            </thead>
            <tbody>
              @if($files_latest <> '[]')
                <?php $no=1; ?>
                @foreach($files_latest as $file)
                <tr>
                  <td>{{$no++}}</td>
                  <td class="FileTitle">
                    @if(Request::server('SERVER_NAME') <> '127.0.0.1')
                      <a href="/pdf.js/web/viewer.html?file=http://{{ Request::server('SERVER_NAME').$file->FilePath }}" target="_blank" id="ThesisLink{{$no}}">
                    @else
                      <a href="/pdf.js/web/viewer.html?file=http://localhost:8000{{$file->FilePath }}" target="_blank" id="ThesisLink{{$no}}">
                    @endif
                      {{ $file->FileTitle }}
                    <script type="text/javascript">
                      $('#ThesisLink{{$no}}').click(function(){
                        $.ajax({
                          type: 'POST',
                          url: '/increment_views',
                          data: {
                            'no_of_views': 1,
                            'FileTitle': '{{$file->FileTitle}}'
                          },
                          success: function(data){
                            // console.log(data['FileTitle']);
                            alert(data);
                          },
                          error: function(){
                            alert('Error')
                          }
                        });
                        // alert('{{$file->FileTitle}}')
                      });
                    </script>
                  </td>
                  <td>{{$file->Authors}}</td>
                  <td>{{$file->Adviser}}</td>
                  <td>{{$file->Category}}</td>
                  <td>{{$file->thesis_date}}</td>
                  <td></td>
                  <td>{{$file->no_of_views}}</td>
                </tr>
                @endforeach
              @endif
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