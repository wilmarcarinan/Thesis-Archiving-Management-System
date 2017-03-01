@extends('layouts.app')

@section('content')
<div class="container" style="padding-top: 70px;">
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
                <th class="width"></th>
                <th class="width"></th>
                <th class="width"></th>
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
          {{-- {{$files->links()}} --}}
        <br />
        </div>
        {{-- <center>
          <button type="button" class="btn btn-info">View more</button>
        </center> --}}
      </div>
    </div>
    <div id="favorites" class="tab-pane fade">
      <div class="container">
        <h2><span class="fa fa-star-o"></span> Favorites</h2>                                                                    
        <div class="table-responsive">          
          <table class="table">
            <thead>
              <tr>
                <th class="width"></th>
                <th class="width"></th>
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
                <tr id="favorites_row{{$favorite->id}}" class="<?php if(!in_array($favorite->id, $favorites)) echo 'hidden'; ?>">
                  <td>
                      <button class="<?php if(in_array($favorite->id, $bookmarks)) echo'not'; else echo "btn" ?>-book" type="button" id="favorites_bookmark{{$favorite->id}}" onclick="$.get( '/bookmark', { 'file_id': {{$favorite->id}} })
                        .done(function(e){
                          //alert(e);
                          // $('#favorite').removeClass('btn-book');
                          if($('#favorites_bookmark{{$favorite->id}}').attr('class')=='not-book'){
                            $('#favorites_bookmark{{$favorite->id}}').attr('class','btn-book');
                            $('#favorites_bookmark{{$favorite->id}} i').attr('class','fa fa-bookmark-o');
                            $('#bookmarks_row{{$favorite->id}}').attr('class','hidden');
                            $('#bookmarks_bookmark{{$favorite->id}}').attr('class','btn-book');
                            $('#bookmarks_bookmark{{$favorite->id}} i').attr('class','fa fa-bookmark-o');
                            $('#bookmark{{$favorite->id}}').attr('class','btn-book');
                            $('#bookmark{{$favorite->id}} i').attr('class','fa fa-bookmark-o');
                          }else{
                            $('#favorites_bookmark{{$favorite->id}}').attr('class','not-book');
                            $('#favorites_bookmark{{$favorite->id}} i').attr('class','fa fa-bookmark');
                            $('#bookmarks_row{{$favorite->id}}').removeClass();
                            $('#bookmarks_bookmark{{$favorite->id}}').attr('class','not-book');
                            $('#bookmarks_bookmark{{$favorite->id}} i').attr('class','fa fa-bookmark');
                            $('#bookmark{{$favorite->id}}').attr('class','not-book');
                            $('#bookmark{{$favorite->id}} i').attr('class','fa fa-bookmark');
                          }
                        });">
                        <i class="fa fa-bookmark<?php if(!in_array($favorite->id, $bookmarks)) echo'-o'; ?>" aria-hidden="true"></i>
                      </button>
                  </td>
                  <td>
                      <button class="<?php if(in_array($favorite->id, $favorites)) echo'not'; else echo "btn" ?>-fav" type="button" id="favorites_favorite{{$favorite->id}}" onclick="$.get( '/favorite', { 'file_id': {{$favorite->id}} })
                      .done(function(e){
                        //alert(e);
                        // $('#favorite').removeClass('btn-book');
                        if($('#favorites_favorite{{$favorite->id}}').attr('class')=='not-fav'){
                          $('#favorites_favorite{{$favorite->id}}').attr('class','btn-fav');
                          $('#favorites_favorite{{$favorite->id}} i').attr('class','fa fa-star-o');
                          $('#favorites_row{{$favorite->id}}').attr('class','hidden');
                          $('#bookmarks_favorite{{$favorite->id}}').attr('class','btn-fav');
                          $('#bookmarks_favorite{{$favorite->id}} i').attr('class','fa fa-star-o');
                          $('#favorite{{$favorite->id}}').attr('class','btn-fav');
                          $('#favorite{{$favorite->id}} i').attr('class','fa fa-star-o');
                        }else{
                          $('#favorites_favorite{{$favorite->id}}').attr('class','not-fav');
                          $('#favorites_favorite{{$favorite->id}} i').attr('class','fa fa-star');
                          $('#bookmarks_favorite{{$favorite->id}}').attr('class','not-fav');
                          $('#bookmarks_favorite{{$favorite->id}} i').attr('class','fa fa-star');
                          $('#favorite{{$favorite->id}}').attr('class','not-fav');
                          $('#favorite{{$favorite->id}} i').attr('class','fa fa-star');
                        }
                      });">
                      <i class="fa fa-star<?php if(!in_array($favorite->id, $favorites)) echo'-o'; ?>" aria-hidden="true"></i>
                    </button>
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
                  <td>{{$favorite->thesis_date->format('F j, Y')}}</td>
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
            {{-- {{$favorite_list->links()}} --}}
          <br />
          {{-- <center>
            <button type="button" class="btn btn-info">View more</button>
          </center> --}}
        </div>
      </div>
    </div>
    <div id="toread" class="tab-pane fade">
      <div class="container">
        <h2><span class="fa fa-bookmark-o"></span> Bookmarks</h2>                                                                        
        <div class="table-responsive">          
          <table class="table">
            <thead>
              <tr>
                <th class="width"></th>
                <th class="width"></th>
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
                <tr id="bookmarks_row{{$bookmark->id}}" class="<?php if(!in_array($bookmark->id, $bookmarks)) echo 'hidden'; ?>">
                  <td>
                      <button class="<?php if(in_array($bookmark->id, $bookmarks)) echo'not'; else echo "btn" ?>-book" type="button" id="bookmarks_bookmark{{$bookmark->id}}" onclick="$.get( '/bookmark', { 'file_id': {{$bookmark->id}} })
                        .done(function(e){
                          //alert(e);
                          // $('#favorite').removeClass('btn-book');
                          if($('#bookmarks_bookmark{{$bookmark->id}}').attr('class')=='not-book'){
                            $('#bookmarks_bookmark{{$bookmark->id}}').attr('class','btn-book');
                            $('#bookmarks_bookmark{{$bookmark->id}} i').attr('class','fa fa-bookmark-o');
                            $('#bookmarks_row{{$bookmark->id}}').attr('class','hidden');
                            $('#favorites_bookmark{{$bookmark->id}}').attr('class','btn-book');
                            $('#favorites_bookmark{{$bookmark->id}} i').attr('class','fa fa-bookmark-o');
                            $('#bookmark{{$bookmark->id}}').attr('class','btn-book');
                            $('#bookmark{{$bookmark->id}} i').attr('class','fa fa-bookmark-o');
                          }else{
                            $('#bookmarks_bookmark{{$bookmark->id}}').attr('class','not-book');
                            $('#bookmarks_bookmark{{$bookmark->id}} i').attr('class','fa fa-bookmark');
                            $('#favorites_bookmark{{$bookmark->id}}').attr('class','not-book');
                            $('#favorites_bookmark{{$bookmark->id}} i').attr('class','fa fa-bookmark');
                            $('#bookmark{{$bookmark->id}}').attr('class','not-book');
                            $('#bookmark{{$bookmark->id}} i').attr('class','fa fa-bookmark');
                          }
                        });">
                        <i  class="fa fa-bookmark<?php if(!in_array($bookmark->id, $bookmarks)) echo'-o'; ?>" aria-hidden="true"></i>
                      </button>
                  </td>
                  <td>
                      <button class="<?php if(in_array($bookmark->id, $favorites)) echo'not'; else echo "btn" ?>-fav" type="button" id="bookmarks_favorite{{$bookmark->id}}" onclick="$.get( '/favorite', { 'file_id': {{$bookmark->id}} })
                      .done(function(e){
                        //alert(e);
                        // $('#favorite').removeClass('btn-book');
                        if($('#bookmarks_favorite{{$bookmark->id}}').attr('class')=='not-fav'){
                          $('#bookmarks_favorite{{$bookmark->id}}').attr('class','btn-fav');
                          $('#bookmarks_favorite{{$bookmark->id}} i').attr('class','fa fa-star-o');
                          $('#favorites_row{{$bookmark->id}}').attr('class','hidden');
                          $('#favorites_favorite{{$bookmark->id}}').attr('class','btn-fav');
                          $('#favorites_favorite{{$bookmark->id}} i').attr('class','fa fa-star-o');
                          $('#favorite{{$bookmark->id}}').attr('class','btn-fav');
                          $('#favorite{{$bookmark->id}} i').attr('class','fa fa-star-o');
                        }else{
                          $('#bookmarks_favorite{{$bookmark->id}}').attr('class','not-fav');
                          $('#bookmarks_favorite{{$bookmark->id}} i').attr('class','fa fa-star');
                          $('#favorites_row{{$bookmark->id}}').removeClass();
                          $('#favorites_favorite{{$bookmark->id}}').attr('class','not-fav');
                          $('#favorites_favorite{{$bookmark->id}} i').attr('class','fa fa-star');
                          $('#favorite{{$bookmark->id}}').attr('class','not-fav');
                          $('#favorite{{$bookmark->id}} i').attr('class','fa fa-star');
                          console.log('Ca');
                        }
                      });">
                      <i  class="fa fa-star<?php if(!in_array($bookmark->id, $favorites)) echo'-o'; ?>" aria-hidden="true"></i>
                    </button>
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
                  <td>{{$bookmark->thesis_date->format('F j, Y')}}</td>
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
            {{-- {{$bookmark_list->links()}} --}}
          <br />
          {{-- <center>
            <button type="button" class="btn btn-info">View more</button>
          </center> --}}
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
        <h2 class="modal-title" id="myModalLabel"></h2>
      </div>
      <div class="modal-body">
      <p class="suggested_qrcodeCanvas" style="text-align: center;"></p>
        <h3>Abstract</h3>
        <p>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <span class="abstract"></span>  
        </p>
        <br>
      </div>
      <div class="modal-footer">
      <a href="" target="_blank" id="suggested_link" file_id="" onclick="$.get( '/increment_views', { 'file_id': $('#suggested_link').attr('file_id')});" class="btn btn-primary">
            Read More
          </a>
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
        <h2 class="modal-title" id="myModalLabel"></h2>
      </div>
      <div class="modal-body">
      <p class="most_viewed_qrcodeCanvas" style="text-align: center;"></p>
        <h3>Abstract</h3>
        <p>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <span class="abstract"></span>  
        </p>
        <br>
      </div>
      <div class="modal-footer">
      <a href="" target="_blank" id="most_viewed_link" file_id="" onclick="$.get( '/increment_views', { 'file_id': $('#most_viewed_link').attr('file_id')});" class="btn btn-primary">
            Read More
          </a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<style type="text/css">
  .width{
    width: 1px;
  }
</style>
@endsection