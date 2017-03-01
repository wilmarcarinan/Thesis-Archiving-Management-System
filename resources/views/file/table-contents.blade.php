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
        <i  class="fa fa-star<?php if(!in_array($file->id, $favorites)) echo'-o'; ?>" aria-hidden="true"></i>
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
          <button class="btn btn-primary" type="submit"><i class="fa fa-unlock-alt" aria-hidden="true"></i></button>
      @else
        <form action="/lock" method="POST">
          {{method_field('PATCH')}}
          {{csrf_field()}}
          <input type="hidden" name="file_id" value="{{$file->id}}">
          <button class="btn btn-primary" type="submit"><i class="fa fa-lock" aria-hidden="true"></i></button>
      @endif
        </form>
    </td>
    <td>
      {{-- <button class="btn btn-primary" type="submit"></button> --}}
      <!-- Button trigger modal -->
      <button class="btn btn-primary updateFile" data-toggle="modal" data-target="#updateModal" data-id="{{$file->id}}" data-title="{{$file->FileTitle}}" data-abstract="{{$file->Abstract}}" data-path="{{$file->FilePath}}" data-category="{{$file->Category}}" data-authors="{{$file->Authors}}" data-course="{{$file->Course}}" data-adviser="{{$file->Adviser}}" data-date="{{$file->thesis_date->toDateString()}}" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
    </td>
    @endif
    <td class="FileTitle">
      <!-- Button trigger modal -->
      <a class="btn viewInfo" data-toggle="modal" data-target="#myModal" data-id="{{$file->id}}" data-title="{{$file->FileTitle}}" data-abstract="{{$file->Abstract}}" data-path="{{$file->FilePath}}" data-authors="{{$file->Authors}}" data-adviser="{{$file->Adviser}}" data-category="{{$file->Category}}">
        {{$file->FileTitle}}
      </a>
      {{-- <p class="fileAbstract"></p> --}}
      {{-- (Background statement) The spread of antibiotic resistance is aided by mobile elements such as transposons and conjugative plasmids. (Narrowing statement) Recently, integrons have been recognised as genetic elements that have the capacity to contribute to the spread of resistance. (Elaboration of narrowing) (statement) Integrons constitute an efficient means of capturing gene cassettes and allow expression of encoded resistance. (Aims) The aims of this study were to screen clinical isolates for integrons, characterise gene cassettes and extended spectrum b-lactamase (ESBL) genes.  (Extended aim) Subsequent to this, genetic linkage between ESBL genes and gentamicin resistance was investigated.  (Results) In this study, 41 % of multiple antibiotic resistant bacteria and 79 % of extended-spectrum b-lactamase producing organisms were found to carry either one or two integrons, as detected by PCR.  (Results)  A novel gene cassette contained within an integron was identified from Stenotrophomonas maltophilia, encoding a protein that belongs to the small multidrug resistance (SMR) family of transporters. (Results)  pLJ1, a transferable plasmid that was present in 86 % of the extended-spectrum b-lactamase producing collection, was found to harbour an integron carrying aadB, a gene cassette for gentamicin, kanamycin and tobramycin resistance and a blaSHV-12 gene for third generation cephalosporin resistance. (Justification of results) The presence of this plasmid accounts for the gentamicin resistance phenotype that is often associated with organisms displaying an extended-spectrum b-lactamase phenotype. --}}
    </td>
    <td id="Abstract{{$file->id}}" class="hidden">{{$file->Abstract}}</td>
    <td id="Authors{{$file->id}}" class="hidden">{{$file->Authors}}</td>
    <td id="Adviser{{$file->id}}" class="hidden">{{$file->Adviser}}</td>
    <td id="Category{{$file->id}}">{{$file->Category}}</td>
    <td id="Course{{$file->id}}">
      <a href="/collections/{{$file->Course}}">{{$file->Course}}</a>
    </td>
    @if(Auth::user()->Role == 'Admin' || Request::path()=='profile' || Request::path()=='list')
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
        <form class="form NotesForm">
          {{-- {{csrf_field()}} --}}
          {{-- {{method_field('PATCH')}} --}}
          <input type="hidden" name="_token" id="Notestoken" value="{{csrf_token()}}">
          {{-- <input type="hidden" name="_method" id="method" value="PATCH"> --}}

          <div class="form-group">
            {{-- <label for="notes">Notes: </label> --}}
            <textarea name="notes" rows="10" class="form-control" id="edit_notes"></textarea>
          </div>

          <button type="submit" class="btn btn-primary notesButton" onclick="
            var type = '';
            if($(this).text() == 'Save'){
              type = 'POST';
            }else{
              type = 'PATCH';
            }
            // alert(type);
            $.ajax({
              type: type,
              url: $('.NotesForm').attr('action'),
              data: {
                // '_method': $('#method').val(),
                '_token': $('#Notestoken').val(),
                'id': $('#NoteID').val(),
                'note': $('#edit_notes').val(),
                'file_id': $('#FileNote_id').val()
              },
              success:function(data){
                console.log(data);
                // $('#notesModal').modal('hide');
              },
              error: function(xhr,textStatus,thrownError){
                console.log(textStatus);
                console.log(xhr.status);
                console.log(thrownError);
              }
            });
          "></button>
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

<!-- Link for More Details Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
          <a href="" target="_blank" id="file_link" file_id="" onclick="$.get( '/View_PDF', { 'file_id': $('#file_link').attr('file_id')})
          .done(function(data){

          });
          ">
            here.
          </a>
        </p>
        <br>
        <p class="qrcodeCanvas" style="text-align: center;"></p>
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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit File</h4>
      </div>
      <div class="modal-body">
        <form action="/updateFile" method="POST" class="form">
          {{-- {{csrf_field()}} --}}
          {{-- {{method_field('PATCH')}} --}}
          <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
          <input type="hidden" name="_method" id="method" value="PATCH">

          <div class="form-group">
            <label for="edit_title">Title: </label>
            <input type="text" class="form-control" name="edit_title" id="edit_title">
          </div>

          <div class="form-group">
            <label for="edit_abstract">Abstract: </label>
            <textarea name="edit_abstract" id="edit_abstract" rows="4" class="form-control"></textarea>
          </div>

          <div class="form-group">
            <label for="edit_category">Categories: </label>
            <textarea name="edit_category" id="edit_category" rows="2" class="form-control"></textarea>
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

          <button type="submit" class="btn btn-primary" onclick="
            $.ajax({
              type: 'PATCH',
              url: '/updateFile',
              data: {
                // '_method': $('#method').val(),
                '_token': $('#token').val(),
                'title': $('#edit_title').val(),
                'abstract': $('#edit_abstract').val(),
                'categories': $('#edit_category').val(),
                'authors': $('#edit_authors').val(),
                'course': $('#edit_course').val(),
                'adviser': $('#edit_adviser').val(),
                'thesis_date': $('#edit_date').val(),
                'id': $('#edit_id').val()
              },
              // dataType: 'jsonp',
              success: function(data){
                $('a[data-id='+data.id+']').text(data.FileTitle);
                $('#Category'+data.id).text(data.Category);
                $('#Authors'+data.id).text(data.Authors);
                $('#Course'+data.id).html(data.Course);
                $('#Adviser'+data.id).text(data.Adviser);
                $('#ThesisDate'+data.id).text(data.thesis_date);
                $('#updateModal').modal('hide');
              },
              error: function(xhr, textStatus, thrownError){
                console.log(textStatus);
                console.log(xhr.status);
                console.log(thrownError);
              }
            });
          ">Update</button>
          <input type="hidden" id="edit_id" name="edit_id">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>