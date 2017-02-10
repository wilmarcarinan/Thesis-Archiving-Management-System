@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="/css/style.css">
@endsection

@section('content')
<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading"><h2>Latest</h2></div>
    <div class="panel-body container">
      @if($latest_file <> '')
        <div class="w3-card-4 col-md-3 col-md-offset-1 col-sm-4 col-sm-offset-1 col-xs-12" style="padding: 50px 25px;">
          <div class="w3-container">
            <h4><center><b>{{$latest_file->FileTitle}}</b></center></h4><br /><br /><br />
            <p><b>{{$latest_file->Authors}}</b></p> 
            <p>{{$latest_file->thesis_date->format('F j, Y')}}</p>
          </div>
          <center class="w3-container" style="padding: 10px">
            <span class="glyphicon glyphicon-eye-open">
              {{ DB::table('recent_views')->where('file_id',$latest_file->id)->pluck('user_id')->count() }}
            </span>
            <span class="glyphicon glyphicon-star-empty">
              {{ DB::table('favorites')->where('file_id',$latest_file->id)->pluck('user_id')->count() }}
            </span>
            <br />
          </center>
        </div>
        <div class="col-md-1 col-sm-1">
        </div>
        <div class="col-md-5 col-sm-5">
          <h1>{{$latest_file->FileTitle}}</h1>
          <p style="height: 7.5em; overflow: hidden;">{{$latest_file->Abstract}}</p>
          @if(Request::server('SERVER_NAME') <> '127.0.0.1')
            <a href="/pdf.js/web/viewer.html?file=http://files/{{ Request::server('SERVER_NAME').$latest_file->FilePath }}" target="_blank">
          @else
            <a href="/pdf.js/web/viewer.html?file=http://localhost:8000/files/{{$latest_file->FilePath }}" target="_blank">
          @endif
              <button type="button" class="btn btn-info col-sm-offset-1 col-xs-offset-3" >View more</button>
            </a>
        </div>
      @else
        <h2>No Records Found.</h2>
      @endif
    </div>
    {{-- <div class="panel-footer">
    </div> --}}
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
                <th></th>
                <th></th>
                <th><span class="glyphicon glyphicon-sort-by-order"></span></th>
                <th>Title</th>
                <th>Category</th>
                <th>Author/s</th>
                <th>Adviser</th>
                <th>Thesis Date</th>
                <th><span class="glyphicon glyphicon-eye-open"></span></th>
                <th><span class="glyphicon glyphicon-star-empty"></span></th>
              </tr>
            </thead>
            <tbody>
              @include('file.table-contents')
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
                <th></th>
                <th></th>
                <th><span class="glyphicon glyphicon-sort-by-order"></span></th>
                <th>Title</th>
                <th>Category</th>
                <th>Author/s</th>
                <th>Adviser</th>
                <th>Thesis Date</th>
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
                <th></th>
                <th></th>
                <th><span class="glyphicon glyphicon-sort-by-order"></span></th>
                <th>Title</th>
                <th>Category</th>
                <th>Author/s</th>
                <th>Adviser</th>
                <th>Thesis Date</th>
                <th><span class="glyphicon glyphicon-eye-open"></span></th>
                <th><span class="glyphicon glyphicon-star-empty"></span></th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; ?>
              <p class="QRCode hidden">
                @if(Request::server('SERVER_NAME') <> '127.0.0.1')
                  <?php 
                  $path='http://'.Request::server('SERVER_NAME').'/pdf.js/web/viewer.html?file=http://'.Request::server('SERVER_NAME')."/files/";
                  echo $path;
                  ?>
                @else
                  <?php 
                  $path='http://localhost:8000/pdf.js/web/viewer.html?file=http://localhost:8000/files/';
                  echo $path;
                  ?>
                @endif
              </p>
              @foreach($most_viewed as $file)
                <tr>
                  @if(Auth::user()->Role <> 'Admin')
                    {{-- <td> --}}
                    <!-- Button trigger modal -->
                    {{-- <button class="openModal" data-toggle="modal" data-target="#myModal">
                      <i class="fa fa-sticky-note-o" aria-hidden="true"></i>
                    </button> --}}
                    {{-- @if(in_array($file->id,$notes))
                      <form action="/editNotes" method="POST">
                        {{ csrf_field() }}
                        {{method_field('PATCH')}}

                    </form> --}}
                    {{-- </td> --}}
                    <td>
                      <form action="/bookmark" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="file_id" value="{{$file->id}}">
                        @if(in_array($file->id, $bookmarks))
                        <button class="not-book" type="submit" id="favorite">
                          <i  class="fa fa-bookmark" aria-hidden="true"></i>
                        </button>
                        @else
                        <button class="btn-book" type="submit" id="favorite">
                          <i  class="fa fa-bookmark-o" aria-hidden="true"></i>
                        </button>
                        @endif
                      </form>
                    </td>
                    <td>
                      <form action="/favorite" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="file_id" value="{{$file->id}}">
                        @if(in_array($file->id, $favorites))
                        <button class="not-fav" type="submit" id="favorite">
                          <i  class="fa fa-star" aria-hidden="true"></i>
                        </button>
                        @else
                        <button class="btn-fav" type="submit" id="favorite">
                          <i  class="fa fa-star-o" aria-hidden="true"></i>
                        </button>
                        @endif
                      </form>
                    </td>
                  @endif
                  <td>{{$no++}}</td>
                  <td>{{$file->FileTitle}}</td>
                  <td>{{$file->Category}}</td>
                  <td>{{$file->Authors}}</td>
                  <td>{{$file->Adviser}}</td>
                  <td>{{$file->thesis_date}}</td>
                  <td>
                    {{ DB::table('recent_views')->where('file_id',$file->id)->pluck('user_id')->count() }}
                  </td>
                  <td>
                    {{ DB::table('favorites')->where('file_id',$file->id)->pluck('user_id')->count() }}
                  </td>
                </tr>
              @endforeach
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