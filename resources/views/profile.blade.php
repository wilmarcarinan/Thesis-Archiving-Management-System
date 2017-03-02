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
        <table class="table" id="recent-table" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="hidden"></th>
              <th></th>
              <th></th>
              <th></th>
              <th class="hidden">Abstract</th>
              <th class="hidden">Authors</th>
              <th class="hidden">Adviser</th>
              <th>Title</th>
              <th>Category</th>
              {{-- <th>Author/s</th> --}}
              <th>Course</th>
              {{-- <th>Adviser</th> --}}
              <th>Thesis Date</th>
              <th><span class="glyphicon glyphicon-eye-open"></span></th>
              <th><span class="glyphicon glyphicon-star-empty"></span></th>
              @if(Auth::user()->Role == 'Admin')
              <th></th>
              <th></th>
              @endif
            </tr>
          </thead>
          <tbody>
            @include('file.table-contents')
          </tbody>
        </table>
        {{-- <center>
          <button type="button" class="btn btn-info">View more</button>
        </center> --}}
      </div>
    </div>
    <div id="favorites" class="tab-pane fade">
      <div class="container">
        <h2><span class="fa fa-star-o"></span> Favorites</h2>          
        <table class="table profile-table" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th class="hidden">Abstract</th>
              <th class="hidden">Authors</th>
              <th class="hidden">Adviser</th>
              <th>Title</th>
              <th>Category</th>
              {{-- <th>Author/s</th> --}}
              <th>Course</th>
              {{-- <th>Adviser</th> --}}
              <th>Thesis Date</th>
              <th><span class="glyphicon glyphicon-eye-open"></span></th>
              <th><span class="glyphicon glyphicon-star-empty"></span></th>
              @if(Auth::user()->Role == 'Admin')
              <th></th>
              <th></th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach($favorite_list as $favorite)
              <tr id="favorites_row{{$favorite->id}}"{{--  class="<?php if(!in_array($favorite->id, $favorites)) echo 'hidden'; ?>" --}}>
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
                <td>
                  <!-- Button trigger modal -->
                  <button class="openNotes" data-toggle="modal" data-target="#notesModal_favorites" data-note_id="<?php
                    if(in_array($favorite->id,$notes_FileID))
                      echo $notes->where('file_id',$favorite->id)->pluck('id')[0];
                  ?>" data-notes="<?php 
                    if(in_array($favorite->id,$notes_FileID))
                      echo $notes->where('file_id',$favorite->id)->pluck('note')[0];
                    ?>" data-file_id="{{$favorite->id}}" data-user_id="{{Auth::id()}}">
                    <i class="fa fa-sticky-note" aria-hidden="true"></i>
                  </button>
                </td>
                <td class="FileTitle">
                  <!-- Button trigger modal -->
                  <a class="btn viewInfo" data-toggle="modal" data-target="#Modal1" data-id="{{$favorite->id}}" data-title="{{$favorite->FileTitle}}" data-abstract="{{$favorite->Abstract}}" data-path="{{$favorite->FilePath}}" data-authors="{{$favorite->Authors}}" data-adviser="{{$favorite->Adviser}}" data-category="{{$favorite->Category}}">
                    {{$favorite->FileTitle}}
                  </a>
                </td>
                <td class="hidden">{{$favorite->Abstract}}</td>
                <td class="hidden">{{$favorite->Authors}}</td>
                <td class="hidden">{{$favorite->Adviser}}</td>
                <td>{{$favorite->Category}}</td>
                <td>
                  <a href="/collections/{{$favorite->Course}}">{{$favorite->Course}}</a>
                </td>
                <td>{{$favorite->thesis_date->format('F j, Y')}}</td>
                <td>
                  {{ DB::table('recent_views')->where('file_id',$favorite->id)->pluck('user_id')->count() }}
                </td>
                <td>
                  {{ DB::table('favorites')->where('file_id',$favorite->id)->pluck('user_id')->count() }}
                </td>
                @if(Auth::user()->Role == 'Admin')
                <td>
                  @if($favorite->Status == 'Inactive')
                    <form action="/unlock" method="POST">
                      {{method_field('PATCH')}}
                      {{csrf_field()}}
                      <input type="hidden" name="file_id" value="{{$favorite->id}}">
                      <button class="btn btn-primary" type="submit"><i class="fa fa-unlock-alt" aria-hidden="true"></i></button>
                  @else
                    <form action="/lock" method="POST">
                      {{method_field('PATCH')}}
                      {{csrf_field()}}
                      <input type="hidden" name="file_id" value="{{$favorite->id}}">
                      <button class="btn btn-primary" type="submit"><i class="fa fa-lock" aria-hidden="true"></i></button>
                  @endif
                    </form>
                </td>
              @endif
              </tr>
            @endforeach
          </tbody>
        </table>
          {{-- <center>
            <button type="button" class="btn btn-info">View more</button>
          </center> --}}
      </div>
    </div>
    <div id="toread" class="tab-pane fade">
      <div class="container">
        <h2><span class="fa fa-bookmark-o"></span> Bookmarks</h2>
        <table class="table profile-table" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th class="hidden">Abstract</th>
              <th class="hidden">Authors</th>
              <th class="hidden">Adviser</th>
              <th>Title</th>
              <th>Tags</th>
              {{-- <th>Author/s</th> --}}
              <th>Course</th>
              {{-- <th>Adviser</th> --}}
              <th>Thesis Date</th>
              <th><span class="glyphicon glyphicon-eye-open"></span></th>
              <th><span class="glyphicon glyphicon-star-empty"></span></th>
              @if(Auth::user()->Role == 'Admin')
              <th></th>
              <th></th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach($bookmark_list as $bookmark)
              <tr id="bookmarks_row{{$bookmark->id}}"{{--  class="<?php if(!in_array($bookmark->id, $bookmarks)) echo 'hidden'; ?>" --}}>
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
                      }
                    });">
                    <i  class="fa fa-star<?php if(!in_array($bookmark->id, $favorites)) echo'-o'; ?>" aria-hidden="true"></i>
                  </button>
                </td>
                <td>
                  <!-- Button trigger modal -->
                  <button class="openNotes" data-toggle="modal" data-target="#notesModal_bookmarks" data-note_id="<?php
                    if(in_array($bookmark->id,$notes_FileID))
                      echo $notes->where('file_id',$bookmark->id)->pluck('id')[0];
                  ?>" data-notes="<?php 
                    if(in_array($bookmark->id,$notes_FileID))
                      echo $notes->where('file_id',$bookmark->id)->pluck('note')[0];
                    ?>" data-file_id="{{$bookmark->id}}" data-user_id="{{Auth::id()}}">
                    <i class="fa fa-sticky-note" aria-hidden="true"></i>
                  </button>
                </td>
                <td class="FileTitle">
                  <!-- Button trigger modal -->
                  <a class="btn viewInfo" data-toggle="modal" data-target="#Modal2" data-id="{{$bookmark->id}}" data-title="{{$bookmark->FileTitle}}" data-abstract="{{$bookmark->Abstract}}" data-path="{{$bookmark->FilePath}}" data-authors="{{$bookmark->Authors}}" data-adviser="{{$bookmark->Adviser}}" data-category="{{$bookmark->Category}}">
                    {{$bookmark->FileTitle}}
                  </a>
                </td>
                <td class="hidden">{{$bookmark->Abstract}}</td>
                <td class="hidden">{{$bookmark->Authors}}</td>
                <td class="hidden">{{$bookmark->Adviser}}</td>
                <td>{{$bookmark->Category}}</td>
                <td>
                  <a href="/collections/{{$bookmark->Course}}">{{$bookmark->Course}}</a>
                </td>
                <td>{{$bookmark->thesis_date->format('F j, Y')}}</td>
                <td>
                  {{ DB::table('recent_views')->where('file_id',$bookmark->id)->pluck('user_id')->count() }}
                </td>
                <td>
                  {{ DB::table('bookmarks')->where('file_id',$bookmark->id)->pluck('user_id')->count() }}
                </td>
                @if(Auth::user()->Role == 'Admin')
                <td>
                  @if($bookmark->Status == 'Inactive')
                    <form action="/unlock" method="POST">
                      {{method_field('PATCH')}}
                      {{csrf_field()}}
                      <input type="hidden" name="file_id" value="{{$bookmark->id}}">
                      <button class="btn btn-primary" type="submit"><i class="fa fa-unlock-alt" aria-hidden="true"></i></button>
                  @else
                    <form action="/lock" method="POST">
                      {{method_field('PATCH')}}
                      {{csrf_field()}}
                      <input type="hidden" name="file_id" value="{{$bookmark->id}}">
                      <button class="btn btn-primary" type="submit"><i class="fa fa-lock" aria-hidden="true"></i></button>
                  @endif
                    </form>
                </td>
              @endif
              </tr>
            @endforeach
          </tbody>
        </table>
          {{-- <center>
            <button type="button" class="btn btn-info">View more</button>
          </center> --}}
      </div>
    </div>
  </div>
</div>

<!-- Add/Edit Notes Modal for Favorites-->
<div class="modal fade" id="notesModal_favorites" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Thesis Notes</h4>
      </div>
      <div class="modal-body">
        <form class="form" id="NotesForm_favorites">
          {{-- {{csrf_field()}} --}}
          {{-- {{method_field('PATCH')}} --}}
          <input type="hidden" name="_token" id="Notestoken_favorites" value="{{csrf_token()}}">
          <div id="methodHandler_favorites"></div>
          {{-- <input type="hidden" name="_method" id="method" value="PATCH"> --}}

          <div class="form-group">
            {{-- <label for="notes">Notes: </label> --}}
            <textarea name="notes" rows="10" class="form-control" id="edit_notes_favorites"></textarea>
          </div>

          <button type="button" class="btn btn-primary" id="notesButton_favorites" onclick="
            var type = '';
            if($(this).text() == 'Save'){
              type = 'POST';
            }else{
              type = 'PATCH';
            }
            // alert($('#edit_notes').val());
            $.ajax({
              type: type,
              url: $('#NotesForm_favorites').attr('action'),
              data: {
                // '_method': $('#method').val(),
                '_token': $('#Notestoken_favorites').val(),
                'id': $('#NoteID_favorites').val(),
                'note': $('#edit_notes_favorites').val(),
                'file_id': $('#FileNote_id_favorites').val()
              },
              success:function(data){
                console.log(data);
                $('button[data-file_id='+data.file_id+']').data('notes',data.note);
                $('#notesModal_favorites').modal('hide');
              },
              error: function(xhr,textStatus,thrownError){
                console.log(textStatus);
                console.log(xhr.status);
                console.log(thrownError);
              }
            });
          "></button>
          <input type="hidden" id="FileNote_id_favorites" name="FileNote_id">
          <input type="hidden" id="NoteID_favorites" name="NoteID">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Add/Edit Notes Modal for Bookmarks-->
<div class="modal fade" id="notesModal_bookmarks" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Thesis Notes</h4>
      </div>
      <div class="modal-body">
        <form class="form" id="NotesForm_bookmarks">
          {{-- {{csrf_field()}} --}}
          {{-- {{method_field('PATCH')}} --}}
          <input type="hidden" name="_token" id="Notestoken_bookmarks" value="{{csrf_token()}}">
          <div id="methodHandler_bookmarks"></div>
          {{-- <input type="hidden" name="_method" id="method" value="PATCH"> --}}

          <div class="form-group">
            {{-- <label for="notes">Notes: </label> --}}
            <textarea name="notes" rows="10" class="form-control" id="edit_notes_bookmarks"></textarea>
          </div>

          <button type="button" class="btn btn-primary" id="notesButton_bookmarks" onclick="
            var type = '';
            if($(this).text() == 'Save'){
              type = 'POST';
            }else{
              type = 'PATCH';
            }
            // alert($('#edit_notes').val());
            $.ajax({
              type: type,
              url: $('#NotesForm_bookmarks').attr('action'),
              data: {
                // '_method': $('#method').val(),
                '_token': $('#Notestoken_bookmarks').val(),
                'id': $('#NoteID_bookmarks').val(),
                'note': $('#edit_notes_bookmarks').val(),
                'file_id': $('#FileNote_id_bookmarks').val()
              },
              success:function(data){
                console.log(data);
                $('button[data-file_id='+data.file_id+']').data('notes',data.note);
                $('#notesModal_bookmarks').modal('hide');
              },
              error: function(xhr,textStatus,thrownError){
                console.log(textStatus);
                console.log(xhr.status);
                console.log(thrownError);
              }
            });
          "></button>
          <input type="hidden" id="FileNote_id_bookmarks" name="FileNote_id">
          <input type="hidden" id="NoteID_bookmarks" name="NoteID">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        <h4><b>Authors</b></h4>
        <p>
          <span class="authors"></span>
        </p>
        <h4><b>Adviser</b></h4>
        <p>
          <span class="adviser"></span>
        </p>
        <h4><b>Tags</b></h4>
        <p>
          <span class="category"></span>
        </p>
        <h4><b>Abstract</b></h4>
        <p>
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
        <h4><b>Authors</b></h4>
        <p>
          <span class="authors"></span>
        </p>
        <h4><b>Adviser</b></h4>
        <p>
          <span class="adviser"></span>
        </p>
        <h4><b>Tags</b></h4>
        <p>
          <span class="category"></span>
        </p>
        <h4><b>Abstract</b></h4>
        <p>
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

@section('script-section')
<script>
  $(document).ready(function(){
    $('.profile-table').DataTable({
      responsive: true,
      stateSave: true,
    });
    $('#recent-table').DataTable({
      responsive: true,
      order: ['0','desc']
    });
  });
</script>
@endsection