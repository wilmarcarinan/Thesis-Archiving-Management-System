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
@foreach($files as $file)
  <tr>
    @if(Request::path() == 'profile')
      <td class="hidden">
        {{$file->pivot->created_at}}
      </td>
    @endif
    @if(Auth::user()->Role <> 'Admin')
      <td>
        <button class="<?php if(in_array($file->id, $bookmarks)) echo 'not'; else echo 'btn' ?>-book" type="button" id="bookmark{{$file->id}}" onclick="$.get( '/bookmark', { 'file_id': {{$file->id}} })
          .done(function(e){
            console.log(e);
            if($('#bookmark{{$file->id}}').attr('class')=='not-book'){
              $('#bookmark{{$file->id}}').attr('class','btn-book');
              $('#bookmark{{$file->id}} i').attr('class','fa fa-bookmark-o');
              
              if(document.getElementById('bookmarks_bookmark{{$file->id}}') != null && document.getElementById('favorites_bookmark{{$file->id}}') != null){
                $('#bookmarks_bookmark{{$file->id}}').attr('class','btn-book');
                $('#bookmarks_bookmark{{$file->id}} i').attr('class','fa fa-bookmark-o');
                $('#bookmarks_row{{$file->id}}').attr('class','hidden');

                $('#favorites_bookmark{{$file->id}}').attr('class','btn-book');
                $('#favorites_bookmark{{$file->id}} i').attr('class','fa fa-bookmark-o');
              }
              
              if(document.getElementById('suggested_bookmark{{$file->id}}') != null && document.getElementById('most_viewed_bookmark{{$file->id}}') != null){
                $('#suggested_bookmark{{$file->id}}').attr('class','btn-book');
                $('#suggested_bookmark{{$file->id}} i').attr('class','fa fa-bookmark-o');

                $('#most_viewed_bookmark{{$file->id}}').attr('class','btn-book');
                $('#most_viewed_bookmark{{$file->id}} i').attr('class','fa fa-bookmark-o');
              }
            }else{
              $('#bookmark{{$file->id}}').attr('class','not-book');
              $('#bookmark{{$file->id}} i').attr('class','fa fa-bookmark');
              
              if(document.getElementById('bookmarks_bookmark{{$file->id}}') != null && document.getElementById('favorites_bookmark{{$file->id}}') != null){
                $('#bookmarks_bookmark{{$file->id}}').attr('class','not-book');
                $('#bookmarks_bookmark{{$file->id}} i').attr('class','fa fa-bookmark');
                $('#bookmarks_row{{$file->id}}').attr('class','');

                $('#favorites_bookmark{{$file->id}}').attr('class','not-book');
                $('#favorites_bookmark{{$file->id}} i').attr('class','fa fa-bookmark'); 
              }
              
              if(document.getElementById('suggested_bookmark{{$file->id}}') != null && document.getElementById('most_viewed_bookmark{{$file->id}}') != null){
                $('#suggested_bookmark{{$file->id}}').attr('class','not-book');
                $('#suggested_bookmark{{$file->id}} i').attr('class','fa fa-bookmark');

                $('#most_viewed_bookmark{{$file->id}}').attr('class','not-book');
                $('#most_viewed_bookmark{{$file->id}} i').attr('class','fa fa-bookmark'); 
              }
            }
          });">
          <i  class="fa fa-bookmark<?php if(!in_array($file->id, $bookmarks)) echo'-o'; ?>" aria-hidden="true"></i>
        </button>
    </td>
    <td>
        <button class="<?php if(in_array($file->id, $favorites)) echo 'not'; else echo 'btn' ?>-fav" type="button" id="favorite{{$file->id}}" onclick="$.get( '/favorite', { 'file_id': {{$file->id}} })
        .done(function(e){
          console.log(e);
          if($('#favorite{{$file->id}}').attr('class')=='not-fav'){
            $('#favorite{{$file->id}}').attr('class','btn-fav');
            $('#favorite{{$file->id}} i').attr('class','fa fa-star-o');
            if(document.getElementById('bookmarks_favorite{{$file->id}}') != null && document.getElementById('favorites_favorite{{$file->id}}') != null){
              $('#bookmarks_favorite{{$file->id}}').attr('class','btn-fav');
              $('#bookmarks_favorite{{$file->id}} i').attr('class','fa fa-star-o');

              $('#favorites_favorite{{$file->id}}').attr('class','btn-fav');
              $('#favorites_favorite{{$file->id}} i').attr('class','fa fa-star-o');
              $('#favorites_row{{$file->id}}').attr('class','hidden');
            }
            if(document.getElementById('suggested_favorite{{$file->id}}') != null && document.getElementById('most_viewed_favorite{{$file->id}}') != null){
              $('#suggested_favorite{{$file->id}}').attr('class','btn-fav');
              $('#suggested_favorite{{$file->id}} i').attr('class','fa fa-star-o');

              $('#most_viewed_favorite{{$file->id}}').attr('class','btn-fav');
              $('#most_viewed_favorite{{$file->id}} i').attr('class','fa fa-star-o');
            }
          }else{
            $('#favorite{{$file->id}}').attr('class','not-fav');
            $('#favorite{{$file->id}} i').attr('class','fa fa-star');
            if(document.getElementById('bookmarks_favorite{{$file->id}}') != null && document.getElementById('favorites_favorite{{$file->id}}') != null){
              $('#bookmarks_favorite{{$file->id}}').attr('class','not-fav');
              $('#bookmarks_favorite{{$file->id}} i').attr('class','fa fa-star');

              $('#favorites_favorite{{$file->id}}').attr('class','not-fav');
              $('#favorites_favorite{{$file->id}} i').attr('class','fa fa-star');
              $('#favorites_row{{$file->id}}').attr('class','');
            }
            if(document.getElementById('suggested_favorite{{$file->id}}') != null && document.getElementById('most_viewed_favorite{{$file->id}}') != null){
              $('#suggested_favorite{{$file->id}}').attr('class','not-fav');
              $('#suggested_favorite{{$file->id}} i').attr('class','fa fa-star');

              $('#most_viewed_favorite{{$file->id}}').attr('class','not-fav');
              $('#most_viewed_favorite{{$file->id}} i').attr('class','fa fa-star');
            }
          }
        });">
        <i class="fa fa-star<?php if(!in_array($file->id, $favorites)) echo'-o'; ?>" aria-hidden="true"></i>
      </button>
    </td>
    <td>
      <!-- Button trigger modal -->
      <button class="openNotes" data-toggle="modal" data-target="#notesModal" data-note_id="<?php
        if(in_array($file->id,$notes_FileID))
          echo $notes->where('file_id',$file->id)->pluck('id')[0];
      ?>" data-notes="<?php 
        if(in_array($file->id,$notes_FileID))
          echo $notes->where('file_id',$file->id)->pluck('note')[0];
        ?>" data-file_id="{{$file->id}}" data-user_id="{{Auth::id()}}">
        <i class="fa fa-sticky-note" aria-hidden="true"></i>
      </button>
    </td>
    @else
    <td>
      @if($file->Status == 'Inactive')
        <form action="/unlock" method="POST">
          {{method_field('PATCH')}}
          {{csrf_field()}}
          <input type="hidden" name="file_id" value="{{$file->id}}">
          <button class="btn btn-primary" type="submit">
            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
          </button>
        </form>
      @else
        <form action="/lock" method="POST">
          {{method_field('PATCH')}}
          {{csrf_field()}}
          <input type="hidden" name="file_id" value="{{$file->id}}">
          <button class="btn btn-primary" type="submit">
            <i class="fa fa-lock" aria-hidden="true"></i>
          </button>
        </form>
      @endif
    </td>
    <td>
      <!-- Button trigger modal for Edit File-->
      <button class="btn btn-primary updateFile" data-toggle="modal" data-target="#updateModal" data-id="{{$file->id}}" data-title="{{$file->FileTitle}}" data-abstract="{{$file->Abstract}}" data-subject="{{$file->SubjectArea}}" data-path="{{$file->FilePath}}" data-category="{{$file->tags->pluck('tag_name')->implode(',')}}" data-authors="{{$file->Authors}}" data-course="{{$file->Course}}" data-adviser="{{$file->Adviser}}" data-date="{{$file->thesis_date->toDateString()}}">
        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
      </button>
    </td>
    @endif
    <td class="FileTitle">
      <!-- Button trigger modal -->
      <a class="btn viewInfo" data-toggle="modal" data-target="#myModal" data-id="{{$file->id}}" data-title="{{$file->FileTitle}}" data-abstract="{{$file->Abstract}}" data-path="{{$file->FilePath}}" data-authors="{{$file->Authors}}" data-adviser="{{$file->Adviser}}" data-category="{{$file->Category}}">
        {{$file->FileTitle}}
      </a>
    </td>
    <td id="Abstract{{$file->id}}" class="hidden">{{$file->Abstract}}</td>
    <td id="SubjectArea{{$file->id}}">{{$file->SubjectArea}}</td>
    <td id="Authors{{$file->id}}" class="hidden">{{$file->Authors}}</td>
    <td id="Adviser{{$file->id}}" class="hidden">{{$file->Adviser}}</td>
    {{-- <td id="Category{{$file->id}}">{{$file->Category}}</td> --}}
    <td id="Category{{$file->id}}">{{$file->tags->pluck('tag_name')->implode(',')}}</td>
    <td id="Course{{$file->id}}">
      <a href="/collections/{{$file->Course}}">{{$file->Course}}</a>
    </td>
    @if(Auth::user()->Role == 'Admin' || Request::path()=='profile' || Request::path()=='list' || Request::path()=='collections/'.$file->Course)
    <td id="ThesisDate{{$file->id}}">{{$file->thesis_date->format('F j, Y')}}</td>
    @else
    <td id="ThesisDate{{$file->id}}">{{$file->thesis_date->format('Y-m-d')}}</td>
    @endif
    @if(Auth::user()->Role == 'Admin')
      <td>{{ $file->Status }}</td>
    @endif
    <td>
      {{ DB::table('recent_views')->where('file_id',$file->id)->pluck('user_id')->count() }}
    </td>
    <td>
      {{ DB::table('favorites')->where('file_id',$file->id)->pluck('user_id')->count() }}
    </td>
  </tr>
@endforeach

<!-- Add/Edit Notes Modal -->
<div class="modal fade" id="notesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Thesis Notes</h4>
      </div>
      <div class="modal-body">
        <form class="form" id="NotesForm">
          <input type="hidden" name="_token" id="Notestoken" value="{{csrf_token()}}">
          <div id="methodHandler"></div>
          <div class="form-group">
            <textarea name="notes" rows="10" class="form-control" id="edit_notes"></textarea>
          </div>

          <button type="button" class="btn btn-primary" id="notesButton" onclick="
            var type = '';
            if($(this).text() == 'Save'){
              type = 'POST';
            }else{
              type = 'PATCH';
            }
            // alert(type);
            $.ajax({
              type: type,
              url: $('#NotesForm').attr('action'),
              data: {
                // '_method': $('#NotesMethod').val(),
                '_token': $('#Notestoken').val(),
                'id': $('#NoteID').val(),
                'note': $('#edit_notes').val(),
                'file_id': $('#FileNote_id').val()
              },
              success:function(data){
                console.log(data);
                $('button[data-file_id='+data.file_id+']').data('notes',data.note);
                //$('button[data-file_id='+data.file_id+']').attr('data-notes',data.note);
                // $('#edit_notes').text(data.note);
                if(type=='POST'){
                  if(data == 'error'){
                    swal('Error Saving!','You didn\'t enter anything!','error');
                  }else{
                    swal('Success','Note Saved!','success');
                  }
                }else{
                  if(data == 'Nothing Changed!'){
                    swal('Error Updating!','You didn\'t change anything!','error');
                  }else{
                    swal('Success','Note Updated!','success');
                  }
                }
                $('#notesModal').modal('hide');
              },
              error: function(xhr,textStatus,thrownError){
                console.log(textStatus);
                console.log(xhr.status);
                console.log(thrownError);
                if(type == 'POST'){
                  swal('Error!','Saving Note Failed!','error');
                }else{
                  swal('Error!','Updating Note Failed!','error');
                }
              }
            });
          "></button>
          <span id="deleteHandler"></span>
          <input type="hidden" id="FileNote_id" name="FileNote_id">
          <input type="hidden" id="NoteID" name="NoteID">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Update File Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Edit File</h4>
      </div>
      <form action="/updateFile" method="POST" class="form">
        <div class="modal-body">
          <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
          <input type="hidden" name="_method" id="method" value="PATCH">

          <div class="form-group">
            <label for="edit_title">Title: </label>
            <input type="text" class="form-control" name="edit_title" id="edit_title">
          </div>

          <div class="form-group">
            <label for="edit_abstract">Abstract: </label>
            <textarea name="edit_abstract" id="edit_abstract" rows="4" class="form-control" onkeydown="charLimit(this.form.edit_abstract,this.form.countdown,1250);" maxlength="1250"></textarea>
          </div>

          <div class="form-group">
            <label for="edit_subject">Subject Area: </label>
            <input type="text" class="form-control" name="edit_subject" id="edit_subject">
          </div>

          <div class="form-group">
            <label for="edit_category">Tags: </label>
            <input type="text" data-role="tagsinput" name="edit_category" id="edit_category">
          </div>
          
          <div class="form-group">
            <label for="edit_authors">Author/s: </label>
            <textarea name="edit_authors" id="edit_authors" rows="2" class="form-control"></textarea>
          </div>

          <div class="form-group">
            <label for="edit_course">Course: </label>
            <select name="edit_course" id="edit_course" class="form-control">
              <option value="">Select Course</option>
              <option value="BSIT">BSIT</option>
              <option value="BSIS">BSIS</option>
              <option value="BSCS">BSCS</option>
            </select>
          </div>

          <div class="form-group">
            <label for="edit_adviser">Adviser: </label>
            <input type="text" class="form-control" name="edit_adviser" id="edit_adviser">
          </div>

          <div class="form-group">
            <label for="edit_date">Thesis Date: </label>
            <input type="date" class="form-control" name="edit_date" id="edit_date">
          </div>
          <input type="hidden" id="edit_id" name="edit_id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="
            $.ajax({
              type: 'PATCH',
              url: '/updateFile',
              data: {
                '_token': $('#token').val(),
                'title': $('#edit_title').val(),
                'abstract': $('#edit_abstract').val(),
                'subject': $('#edit_subject').val(),
                'tags': $('#edit_category').val(),
                'authors': $('#edit_authors').val(),
                'course': $('#edit_course').val(),
                'adviser': $('#edit_adviser').val(),
                'thesis_date': $('#edit_date').val(),
                'id': $('#edit_id').val()
              },
              success: function(data){
                console.log(data);
                var thesis_date = new Date(data.thesis_date);
                var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

                // Update the File Title link data-fields
                $('a[data-id='+data.id+']').data('title',data.title);
                $('a[data-id='+data.id+']').data('abstract',data.abstract);
                $('a[data-id='+data.id+']').data('category',data.tags);
                $('a[data-id='+data.id+']').data('authors',data.authors);
                $('a[data-id='+data.id+']').data('adviser',data.adviser);
                $('a[data-id='+data.id+']').text(data.title);

                // Update the Edit File Button data-fields                
                $('button[data-id='+data.id+']').data('abstract',data.abstract);
                $('button[data-id='+data.id+']').data('subject',data.subject);
                $('button[data-id='+data.id+']').data('category',data.tags);
                $('button[data-id='+data.id+']').data('adviser',data.adviser);
                $('button[data-id='+data.id+']').data('course',data.course);
                $('button[data-id='+data.id+']').data('title',data.title);
                $('button[data-id='+data.id+']').data('date',data.thesis_date);

                // Update the fields in the table that users can see
                $('#Abstract'+data.id).text(data.abstract);
                $('#SubjectArea'+data.id).text(data.subject);
                $('#Category'+data.id).text(data.tags);
                $('#Authors'+data.id).text(data.authors);
                $('#Course'+data.id).html(data.course);
                $('#Adviser'+data.id).text(data.adviser);
                $('#ThesisDate'+data.id).text(months[thesis_date.getMonth()]+' '+thesis_date.getDate()+', '+thesis_date.getFullYear());

                // Prompts Success 
                swal('Success!', 'File Updated Successfully!', 'success');

                // Hide modal after updating
                $('#updateModal').modal('hide');
              },
              error: function(xhr, textStatus, thrownError){
                console.log(textStatus);
                console.log(xhr.status);
                console.log(thrownError);
                swal('Error!', 'File Update Fail!', 'error');
              }
            });
          ">Update</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Link for More Details Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
        <h4>
          <b>Authors</b>
        </h4>
        <p>
          <span class="authors"></span>
        </p>
        <h4>
          <b>Adviser</b>
        </h4>
        <p>
          <span class="adviser"></span>
        </p>
        <h4>
          <b>Tags</b>
        </h4>
        <p>
          <span class="category"></span>
        </p>
        <h4>
          <b>Abstract</b>
        </h4>
        <p>
          <span class="abstract"></span>  
        </p>
        <br>
        <p class="qrcodeCanvas" style="text-align: center;"></p>
      </div>
      <div class="modal-footer">
        <a href="" target="_blank" id="file_link" class="btn btn-primary" onclick="
          $.ajax({
            type: 'GET',
            url: 'View_PDF',
            data:{
              'file_id': $('#file_link').attr('file_id')
            }
          });
        ">Read More</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>