@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="/css/style.css">
@endsection

@section('content')
<div class="container">
  @if(session('status'))
    <div class="alert alert-success" style="margin: 20px 0px -20px 0px">
      <li>{{session('status')}}</li>
    </div>
  @endif
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
            <span class="glyphicon glyphicon-eye-open">{{ DB::table('recent_views')->where('file_id',$latest_file->id)->pluck('user_id')->count() }}
            </span>
            <span class="glyphicon glyphicon-star-empty">{{ DB::table('favorites')->where('file_id',$latest_file->id)->pluck('user_id')->count() }}
            </span>
            <br />
          </center>
        </div>
        <div class="col-md-1 col-sm-1">
        </div>
        <div class="col-md-5 col-sm-5">
          <h1>{{$latest_file->FileTitle}}</h1>
          {{-- <p style="height: 7.5em; overflow: hidden;">{{$latest_file->Abstract}}</p> --}}
          <p>{{\Illuminate\Support\Str::words($latest_file->Abstract, $words = 70, $end = '...')}}</p>
          @if(Request::server('SERVER_NAME') <> '127.0.0.1')
            <a href="/pdf.js/web/viewer.html?file=http://{{ Request::server('SERVER_NAME')}}/files/{{Auth::id()}}{{$latest_file->FilePath}}&fidder={{$latest_file->id}}" target="_blank" id="latest_link" file_id="" onclick="$.get( '/increment_views', { 'file_id': $('#latest_link').attr('file_id')});">
          @else
            <a href="/pdf.js/web/viewer.html?file=http://localhost:8000/files/{{Auth::id()}}{{$latest_file->FilePath}}&fidder={{$latest_file->id}}" target="_blank">
          @endif
              <button type="button" class="btn btn-info col-sm-offset-1 col-xs-offset-3">View more</button>
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
        <h2 style="margin-bottom: 15px">Latest</h2>
        {{-- <div class="table-responsive">           --}}
        <table class="table" id="latest_table" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th>Title</th>
              <th class="hidden">Abstract</th>
              <th class="hidden">Authors</th>
              <th class="hidden">Adviser</th>
              <th>Tags</th>
              <th>Course</th>
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
          {{-- {{$files->links()}} --}}
        {{-- <br /> --}}
        {{-- </div> --}}
        {{-- <center>
          <button type="button" class="btn btn-info">View more</button>
        </center> --}}
      </div>
    </div>
    <div id="suggested" class="tab-pane fade">
      <div class="container">
        <h2 style="margin-bottom: 15px">Suggested</h2>                                                  
        {{-- <div class="table-responsive">           --}}
        <table class="table" id="suggested_table" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th>Title</th>
              <th class="hidden">Abstract</th>
              <th class="hidden">Authors</th>
              <th class="hidden">Adviser</th>
              <th>Tags</th>
              <th>Course</th>
              <th>Thesis Date</th>
              <th><span class="glyphicon glyphicon-eye-open"></span></th>
              <th><span class="glyphicon glyphicon-star-empty"></span></th>
            </tr>
          </thead>
          <tbody>
            @foreach($suggested_files as $file)
              <tr>
                @if(Auth::user()->Role <> 'Admin')
                  <td>
                    <button class="<?php if(in_array($file->id, $bookmarks)) echo'not'; else echo "btn" ?>-book" type="button" id="suggested_bookmark{{$file->id}}" onclick="$.get( '/bookmark', { 'file_id': {{$file->id}} })
                      .done(function(){
                        if($('#suggested_bookmark{{$file->id}}').attr('class')=='not-book'){
                          $('#suggested_bookmark{{$file->id}}').attr('class','btn-book');
                          $('#suggested_bookmark{{$file->id}} i').attr('class','fa fa-bookmark-o');
                          $('#most_viewed_bookmark{{$file->id}}').attr('class','btn-book');
                          $('#most_viewed_bookmark{{$file->id}} i').attr('class','fa fa-bookmark-o');
                          $('#bookmark{{$file->id}}').attr('class','btn-book');
                          $('#bookmark{{$file->id}} i').attr('class','fa fa-bookmark-o');
                        }else{
                          $('#suggested_bookmark{{$file->id}}').attr('class','not-book');
                          $('#suggested_bookmark{{$file->id}} i').attr('class','fa fa-bookmark');
                          $('#most_viewed_bookmark{{$file->id}}').attr('class','not-book');
                          $('#most_viewed_bookmark{{$file->id}} i').attr('class','fa fa-bookmark');
                          $('#bookmark{{$file->id}}').attr('class','not-book');
                          $('#bookmark{{$file->id}} i').attr('class','fa fa-bookmark');
                        }
                      });">
                      <i  class="fa fa-bookmark<?php if(!in_array($file->id, $bookmarks)) echo'-o'; ?>" aria-hidden="true"></i>
                    </button>
                  </td>
                  <td>
                      <button class="<?php if(in_array($file->id, $favorites)) echo 'not'; else echo 'btn' ?>-fav" type="button" id="suggested_favorite{{$file->id}}" onclick="$.get( '/favorite', { 'file_id': {{$file->id}} })
                      .done(function(){
                        if($('#suggested_favorite{{$file->id}}').attr('class')=='not-fav'){
                          $('#suggested_favorite{{$file->id}}').attr('class','btn-fav');
                          $('#suggested_favorite{{$file->id}} i').attr('class','fa fa-star-o');
                          $('#most_viewed_favorite{{$file->id}}').attr('class','btn-fav');
                          $('#most_viewed_favorite{{$file->id}} i').attr('class','fa fa-star-o');
                          $('#favorite{{$file->id}}').attr('class','btn-fav');
                          $('#favorite{{$file->id}} i').attr('class','fa fa-star-o');
                        }else{
                          $('#suggested_favorite{{$file->id}}').attr('class','not-fav');
                          $('#suggested_favorite{{$file->id}} i').attr('class','fa fa-star');
                          $('#most_viewed_favorite{{$file->id}}').attr('class','not-fav');
                          $('#most_viewed_favorite{{$file->id}} i').attr('class','fa fa-star');
                          $('#favorite{{$file->id}}').attr('class','not-fav');
                          $('#favorite{{$file->id}} i').attr('class','fa fa-star');
                        }
                      });">
                      <i  class="fa fa-star<?php if(!in_array($file->id, $favorites)) echo'-o'; ?>" aria-hidden="true"></i>
                    </button>
                  </td>
                  <td>
                    <!-- Button trigger modal -->
                    <button class="openNotes" data-toggle="modal" data-target="#notesModal_suggested" data-note_id="<?php
                      if(in_array($file->id,$notes_FileID))
                        echo $notes->where('file_id',$file->id)->pluck('id')[0];
                    ?>" data-notes="<?php 
                      if(in_array($file->id,$notes_FileID))
                        echo $notes->where('file_id',$file->id)->pluck('note')[0];
                      ?>" data-file_id="{{$file->id}}" data-user_id="{{Auth::id()}}">
                      <i class="fa fa-sticky-note" aria-hidden="true"></i>
                    </button>
                  </td>
                @endif
                <td class="FileTitle">
                  <!-- Button trigger modal -->
                  <a class="btn viewInfo" data-toggle="modal" data-target="#Modal2" data-id="{{$file->id}}" data-title="{{$file->FileTitle}}" data-abstract="{{$file->Abstract}}" data-path="{{$file->FilePath}}" data-authors="{{$file->Authors}}" data-adviser="{{$file->Adviser}}" data-category="{{$file->Category}}">
                    {{$file->FileTitle}}
                  </a>
                </td>
                <td class="hidden">{{$file->Abstract}}</td>
                <td class="hidden">{{$file->Authors}}</td>
                <td class="hidden">{{$file->Adviser}}</td>
                <td>{{$file->Category}}</td>
                <td>
                  <a href="/collections/{{$file->Course}}">{{$file->Course}}</a>
                </td>
                <td>{{$file->thesis_date->format('F j, Y')}}</td>
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
            {{-- {{$suggested_files->links()}} --}}
          {{-- <br /> --}}
          {{-- <center>
            <button type="button" class="btn btn-info">View more</button>
          </center> --}}
        {{-- </div> --}}
      </div>
    </div>
    <div id="mostviewed" class="tab-pane fade">
      <div class="container">
        <h2 style="margin-bottom: 15px">Most Viewed</h2>                                                                        
        {{-- <div>           --}}
        <table class="table" id="most_viewed_table" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th>Title</th>
              <th class="hidden">Abstract</th>
              <th class="hidden">Authors</th>
              <th class="hidden">Adviser</th>
              <th>Tags</th>
              <th>Course</th>              
              <th>Thesis Date</th>
              <th><span class="glyphicon glyphicon-eye-open"></span></th>
              <th><span class="glyphicon glyphicon-star-empty"></span></th>
            </tr>
          </thead>
          <tbody>
            @foreach($most_viewed as $file)
              <tr>
                @if(Auth::user()->Role <> 'Admin')
                  <td>
                    <button class="<?php if(in_array($file->id, $bookmarks)) echo'not'; else echo "btn" ?>-book" type="button" id="most_viewed_bookmark{{$file->id}}" onclick="$.get( '/bookmark', { 'file_id': {{$file->id}} })
                      .done(function(){
                        if($('#most_viewed_bookmark{{$file->id}}').attr('class')=='not-book'){
                          $('#most_viewed_bookmark{{$file->id}}').attr('class','btn-book');
                          $('#most_viewed_bookmark{{$file->id}} i').attr('class','fa fa-bookmark-o');
                          $('#suggested_bookmark{{$file->id}}').attr('class','btn-book');
                          $('#suggested_bookmark{{$file->id}} i').attr('class','fa fa-bookmark-o');
                          $('#bookmark{{$file->id}}').attr('class','btn-book');
                          $('#bookmark{{$file->id}} i').attr('class','fa fa-bookmark-o');
                        }else{
                          $('#most_viewed_bookmark{{$file->id}}').attr('class','not-book');
                          $('#most_viewed_bookmark{{$file->id}} i').attr('class','fa fa-bookmark');
                          $('#suggested_bookmark{{$file->id}}').attr('class','not-book');
                          $('#suggested_bookmark{{$file->id}} i').attr('class','fa fa-bookmark');
                          $('#bookmark{{$file->id}}').attr('class','not-book');
                          $('#bookmark{{$file->id}} i').attr('class','fa fa-bookmark');
                        }
                      });">
                      <i  class="fa fa-bookmark<?php if(!in_array($file->id, $bookmarks)) echo'-o'; ?>" aria-hidden="true"></i>
                    </button>
                  </td>
                  <td>
                      <button class="<?php if(in_array($file->id, $favorites)) echo'not'; else echo "btn" ?>-fav" type="button" id="most_viewed_favorite{{$file->id}}" onclick="$.get( '/favorite', { 'file_id': {{$file->id}} })
                      .done(function(){
                        if($('#most_viewed_favorite{{$file->id}}').attr('class')=='not-fav'){
                          $('#most_viewed_favorite{{$file->id}}').attr('class','btn-fav');
                          $('#most_viewed_favorite{{$file->id}} i').attr('class','fa fa-star-o');
                          $('#suggested_favorite{{$file->id}}').attr('class','btn-fav');
                          $('#suggested_favorite{{$file->id}} i').attr('class','fa fa-star-o');
                          $('#favorite{{$file->id}}').attr('class','btn-fav');
                          $('#favorite{{$file->id}} i').attr('class','fa fa-star-o');
                        }else{
                          $('#most_viewed_favorite{{$file->id}}').attr('class','not-fav');
                          $('#most_viewed_favorite{{$file->id}} i').attr('class','fa fa-star');
                          $('#suggested_favorite{{$file->id}}').attr('class','not-fav');
                          $('#suggested_favorite{{$file->id}} i').attr('class','fa fa-star');
                          $('#favorite{{$file->id}}').attr('class','not-fav');
                          $('#favorite{{$file->id}} i').attr('class','fa fa-star');
                        }
                      });">
                      <i  class="fa fa-star<?php if(!in_array($file->id, $favorites)) echo'-o'; ?>" aria-hidden="true"></i>
                    </button>
                  </td>
                  <td>
                    <!-- Button trigger modal -->
                    <button class="openNotes" data-toggle="modal" data-target="#notesModal_most_viewed" data-note_id="<?php
                      if(in_array($file->id,$notes_FileID))
                        echo $notes->where('file_id',$file->id)->pluck('id')[0];
                    ?>" data-notes="<?php 
                      if(in_array($file->id,$notes_FileID))
                        echo $notes->where('file_id',$file->id)->pluck('note')[0];
                      ?>" data-file_id="{{$file->id}}" data-user_id="{{Auth::id()}}">
                      <i class="fa fa-sticky-note" aria-hidden="true"></i>
                    </button>
                  </td>
                @endif
                <td class="FileTitle">
                  <!-- Button trigger modal -->
                  <a class="btn viewInfo" data-toggle="modal" data-target="#Modal3" data-id="{{$file->id}}" data-title="{{$file->FileTitle}}" data-abstract="{{$file->Abstract}}" data-path="{{$file->FilePath}}" data-authors="{{$file->Authors}}" data-adviser="{{$file->Adviser}}" data-category="{{$file->Category}}">
                    {{$file->FileTitle}}
                  </a>
                </td>
                <td class="hidden">{{$file->Abstract}}</td>
                <td class="hidden">{{$file->Authors}}</td>
                <td class="hidden">{{$file->Adviser}}</td>
                <td>{{$file->Category}}</td>
                <td>
                  <a href="/collections/{{$file->Course}}">{{$file->Course}}</a>
                </td>
                <td>{{$file->thesis_date->format('F j, Y')}}</td>
                <td>{{ $file->NumberOfViews }}</td>
                <td>
                  {{ DB::table('favorites')->where('file_id',$file->id)->pluck('user_id')->count() }}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
          {{-- {{$most_viewed->links()}} --}}
          {{-- <br /> --}}
          {{-- <center>
            <button type="button" class="btn btn-info">View more</button>
          </center> --}}
        {{-- </div> --}}
      </div>
    </div>
  </div>
</div>

<!-- Add/Edit Notes Modal for Suggested-->
<div class="modal fade" id="notesModal_suggested" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Thesis Notes</h4>
      </div>
      <div class="modal-body">
        <form class="form" id="NotesForm_suggested">
          {{-- {{csrf_field()}} --}}
          {{-- {{method_field('PATCH')}} --}}
          <input type="hidden" name="_token" id="Notestoken_suggested" value="{{csrf_token()}}">
          {{-- <input type="hidden" name="_method" id="method" value="PATCH"> --}}
          <div id="methodHandler_suggested"></div>
          <div class="form-group">
            {{-- <label for="notes">Notes: </label> --}}
            <textarea name="notes" rows="10" class="form-control" id="edit_notes_suggested"></textarea>
          </div>

          <button type="button" class="btn btn-primary" id="notesButton_suggested" onclick="
            var type = '';
            if($(this).text() == 'Save'){
              type = 'POST';
            }else{
              type = 'PATCH';
            }
            // alert($('#edit_notes').val());
            $.ajax({
              type: type,
              url: $('#NotesForm_suggested').attr('action'),
              data: {
                // '_method': $('#method').val(),
                '_token': $('#Notestoken_suggested').val(),
                'id': $('#NoteID_suggested').val(),
                'note': $('#edit_notes_suggested').val(),
                'file_id': $('#FileNote_id_suggested').val()
              },
              success:function(data){
                console.log(data);
                $('#notesModal_suggested').modal('hide');
              },
              error: function(xhr,textStatus,thrownError){
                console.log(textStatus);
                console.log(xhr.status);
                console.log(thrownError);
              }
            });
          "></button>
          <input type="hidden" id="FileNote_id_suggested" name="FileNote_id">
          <input type="hidden" id="NoteID_suggested" name="NoteID">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Add/Edit Notes Modal for Most Viewed-->
<div class="modal fade" id="notesModal_most_viewed" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Thesis Notes</h4>
      </div>
      <div class="modal-body">
        <form class="form" id="NotesForm_most_viewed">
          {{-- {{csrf_field()}} --}}
          {{-- {{method_field('PATCH')}} --}}
          <input type="hidden" name="_token" id="Notestoken_most_viewed" value="{{csrf_token()}}">
          <div id="methodHandler_most_viewed"></div>
          {{-- <input type="hidden" name="_method" id="method" value="PATCH"> --}}

          <div class="form-group">
            {{-- <label for="notes">Notes: </label> --}}
            <textarea name="notes" rows="10" class="form-control" id="edit_notes_most_viewed"></textarea>
          </div>

          <button type="button" class="btn btn-primary" id="notesButton_most_viewed" onclick="
            var type = '';
            if($(this).text() == 'Save'){
              type = 'POST';
            }else{
              type = 'PATCH';
            }
            // alert($('#edit_notes').val());
            $.ajax({
              type: type,
              url: $('#NotesForm_most_viewed').attr('action'),
              data: {
                // '_method': $('#method').val(),
                '_token': $('#Notestoken_most_viewed').val(),
                'id': $('#NoteID_most_viewed').val(),
                'note': $('#edit_notes_most_viewed').val(),
                'file_id': $('#FileNote_id_most_viewed').val()
              },
              success:function(data){
                console.log(data);
                $('#notesModal_most_viewed').modal('hide');
              },
              error: function(xhr,textStatus,thrownError){
                console.log(textStatus);
                console.log(xhr.status);
                console.log(thrownError);
              }
            });
          "></button>
          <input type="hidden" id="FileNote_id_most_viewed" name="FileNote_id">
          <input type="hidden" id="NoteID_most_viewed" name="NoteID">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Suggested Modal -->
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

<!-- Most Viewed Modal -->
<div class="modal fade" id="Modal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
      $('#suggested_table').DataTable({
        // responsive: true
      });
      $('#latest_table').DataTable({
        responsive: true,
        order: ['9','desc']
      });
      $('#most_viewed_table').DataTable({
        responsive: true,
        order: ['10','desc']
      });
    });
  </script>
@endsection