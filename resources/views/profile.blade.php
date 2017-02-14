@extends('layouts.app')

@section('content')
<div class="container">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#recent">Recent</a></li>
    <li><a data-toggle="tab" href="#favorites">Favorites</a></li>
    <li><a data-toggle="tab" href="#toread">Bookmarks</a></li>
  </ul>
  <div class="tab-content">
    <div id="recent" class="tab-pane fade in active">
      <div class="container">
        <h2><span class="glyphicon glyphicon-time"></span> Recent</h2>
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
                <th>Course</th>
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
    <div id="favorites" class="tab-pane fade">
      <div class="container">
        <h2><span class="glyphicon glyphicon-star-empty"></span> Favorites</h2>                                                                    
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
                <th>Course</th>
                <th>Adviser</th>
                <th>Thesis Date</th>
                <th><span class="glyphicon glyphicon-eye-open"></span></th>
                <th><span class="glyphicon glyphicon-star-empty"></span></th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; ?>
              @foreach($favorite_list as $favorite)
                <tr>
                  <td>
                      <form action="/bookmark" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="file_id" value="{{$favorite->id}}">
                        @if(in_array($favorite->id, $bookmarks))
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
                        <input type="hidden" name="file_id" value="{{$favorite->id}}">
                        @if(in_array($favorite->id, $favorites))
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
                  <td>{{$no++}}</td>
                  <td class="FileTitle">
                    <!-- Button trigger modal -->
                    <a class="btn viewInfo" data-toggle="modal" data-target="#Modal1" data-id="{{$favorite->id}}" data-title="{{$favorite->FileTitle}}" data-abstract="{{$favorite->Abstract}}" data-path="{{$favorite->FilePath}}">
                      {{$favorite->FileTitle}}
                    </a>
                  </td>
                  <td>{{$favorite->Category}}</td>
                  <td>{{$favorite->Authors}}</td>
                  <td>{{$favorite->Course}}</td>
                  <td>{{$favorite->Adviser}}</td>
                  <td>{{$favorite->thesis_date}}</td>
                  <td>
                    {{ DB::table('recent_views')->where('file_id',$favorite->id)->pluck('user_id')->count() }}
                  </td>
                  <td>
                    {{ DB::table('favorites')->where('file_id',$favorite->id)->pluck('user_id')->count() }}
                  </td>
                </tr>
              @endforeach
            </tbody>
            </table>
            {{$favorite_list->links()}}
          <br />
          <center>
            <button type="button" class="btn btn-info">View more</button>
          </center>
        </div>
      </div>
    </div>
    <div id="toread" class="tab-pane fade">
      <div class="container">
        <h2><span class="glyphicon glyphicon-bookmark"></span> Bookmarks</h2>                                                                        
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
                <th>Course</th>
                <th>Adviser</th>
                <th>Thesis Date</th>
                <th><span class="glyphicon glyphicon-eye-open"></span></th>
                <th><span class="glyphicon glyphicon-star-empty"></span></th>
              </tr>
            </thead>
            <tbody>
            <?php $no=1; ?>
              @foreach($bookmark_list as $bookmark)
                <tr>
                  <td>
                      <form action="/bookmark" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="file_id" value="{{$bookmark->id}}">
                        @if(in_array($bookmark->id, $bookmarks))
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
                        <input type="hidden" name="file_id" value="{{$bookmark->id}}">
                        @if(in_array($bookmark->id, $favorites))
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
                  <td>{{$no++}}</td>
                  <td class="FileTitle">
                    <!-- Button trigger modal -->
                    <a class="btn viewInfo" data-toggle="modal" data-target="#Modal2" data-id="{{$bookmark->id}}" data-title="{{$bookmark->FileTitle}}" data-abstract="{{$bookmark->Abstract}}" data-path="{{$bookmark->FilePath}}">
                      {{$bookmark->FileTitle}}
                    </a>
                  </td>
                  <td>{{$bookmark->Category}}</td>
                  <td>{{$bookmark->Authors}}</td>
                  <td>{{$bookmark->Course}}</td>
                  <td>{{$bookmark->Adviser}}</td>
                  <td>{{$bookmark->thesis_date}}</td>
                  <td>
                    {{ DB::table('recent_views')->where('file_id',$bookmark->id)->pluck('user_id')->count() }}
                  </td>
                  <td>
                    {{ DB::table('bookmarks')->where('file_id',$bookmark->id)->pluck('user_id')->count() }}
                  </td>
                </tr>
              @endforeach
            </tbody>
            </table>
            {{$bookmark_list->links()}}
          <br />
          <center>
            <button type="button" class="btn btn-info">View more</button>
          </center>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Favorites Modal -->
<div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
        <h3><b>Abstract</b></h3>
        <p>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <span class="abstract"></span>  
        </p>
        <p>
          Read the whole documentation 
          <a href="" target="_blank" id="suggested_link" file_id="" onclick="$.get( '/increment_views', { 'file_id': $('#suggested_link').attr('file_id')});">
            here.
          </a>
        </p>
        <br>
        <p class="suggested_qrcodeCanvas" style="text-align: center;"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Bookmarks Modal -->
<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
        <h3><b>Abstract</b></h3>
        <p>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <span class="abstract"></span>  
        </p>
        <p>
          Read the whole documentation 
          <a href="" target="_blank" id="most_viewed_link" file_id="" onclick="$.get( '/increment_views', { 'file_id': $('#most_viewed_link').attr('file_id')});">
            here.
          </a>
        </p>
        <br>
        <p class="most_viewed_qrcodeCanvas" style="text-align: center;"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection