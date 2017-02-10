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
@foreach($files as $file)
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
            <input type="hidden" name="file_id" value="{{$file->id}}" class="file_id">
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
    <td class="FileTitle">
      <!-- Button trigger modal -->
      <a class="btn viewInfo" data-toggle="modal" data-target="#myModal" data-title="{{$file->FileTitle}}" data-abstract="{{$file->Abstract}}" data-path="{{$file->FilePath}}">
        {{$file->FileTitle}}
      </a>
      {{-- <p class="fileAbstract"></p> --}}
      {{-- (Background statement) The spread of antibiotic resistance is aided by mobile elements such as transposons and conjugative plasmids. (Narrowing statement) Recently, integrons have been recognised as genetic elements that have the capacity to contribute to the spread of resistance. (Elaboration of narrowing) (statement) Integrons constitute an efficient means of capturing gene cassettes and allow expression of encoded resistance. (Aims) The aims of this study were to screen clinical isolates for integrons, characterise gene cassettes and extended spectrum b-lactamase (ESBL) genes.  (Extended aim) Subsequent to this, genetic linkage between ESBL genes and gentamicin resistance was investigated.  (Results) In this study, 41 % of multiple antibiotic resistant bacteria and 79 % of extended-spectrum b-lactamase producing organisms were found to carry either one or two integrons, as detected by PCR.  (Results)  A novel gene cassette contained within an integron was identified from Stenotrophomonas maltophilia, encoding a protein that belongs to the small multidrug resistance (SMR) family of transporters. (Results)  pLJ1, a transferable plasmid that was present in 86 % of the extended-spectrum b-lactamase producing collection, was found to harbour an integron carrying aadB, a gene cassette for gentamicin, kanamycin and tobramycin resistance and a blaSHV-12 gene for third generation cephalosporin resistance. (Justification of results) The presence of this plasmid accounts for the gentamicin resistance phenotype that is often associated with organisms displaying an extended-spectrum b-lactamase phenotype. --}}

      <!-- Modal -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                <a href="" target="_blank" id="file_link">
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
    </td>
    <td>{{$file->Category}}</td>
    <td>{{$file->Authors}}</td>
    <td>{{$file->Adviser}}</td>
    <td>{{$file->thesis_date->format('F j, Y')}}</td>
    @if(Auth::user()->Role == 'Admin')
      <td>{{ $file->Status }}</td>
    @endif
    <td>{{$file->no_of_views}}</td>
    <td>
      {{ DB::table('favorites')->where('file_id',$file->id)->pluck('user_id')->count() }}
    </td>
    @if(Auth::user()->Role == 'Admin')
      <td>
        @if($file->Status == 'Inactive')
          <form action="/unlock" method="POST">
            {{method_field('PATCH')}}
            {{csrf_field()}}
            <input type="hidden" name="file_id" value="{{$file->id}}">
            <button class="btn btn-primary" type="submit"><span class="fa fa-unlock-alt"></span></button>
        @else
          <form action="/lock" method="POST">
            {{method_field('PATCH')}}
            {{csrf_field()}}
            <input type="hidden" name="file_id" value="{{$file->id}}">
            <button class="btn btn-primary" type="submit"><span class="fa fa-lock"></span></button>
        @endif
          </form>
      </td>
    @endif
  </tr>
@endforeach
{{$files->links()}}
