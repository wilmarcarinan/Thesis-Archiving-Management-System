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
                  <td>{{$favorite->FileTitle}}</td>
                  <td>{{$favorite->Category}}</td>
                  <td>{{$favorite->Authors}}</td>
                  <td>{{$favorite->Adviser}}</td>
                  <td>{{$favorite->thesis_date}}</td>
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
                  <td>{{$bookmark->FileTitle}}</td>
                  <td>{{$bookmark->Category}}</td>
                  <td>{{$bookmark->Authors}}</td>
                  <td>{{$bookmark->Adviser}}</td>
                  <td>{{$bookmark->thesis_date}}</td>
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
</div>	<div class="container">

@endsection