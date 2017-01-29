@extends('layouts.app')

@section('content')
<div class="container">
    <h2><span class="glyphicon glyphicon-list-alt"></span> List All</h2>
    <div class="table-responsive">          
        <table class="table">
            <thead>
              <tr>
                <th><span class="glyphicon glyphicon-sort-by-order"></span></th>
                <th>Title</th>
                <th>Category</th>
                <th>Author/s</th>
                <th>Adviser</th>
                <th>Date</th>
                <th><span class="glyphicon glyphicon-eye-open"></span></th>
                <th><span class="glyphicon glyphicon-star-empty"></span></th>
              </tr>
            </thead>
            <tbody>
                <?php $no=1; ?>
                @foreach($files as $file)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$file->FileTitle}}</td>
                    <td>{{$file->Category}}</td>
                    <td>{{$file->Authors}}</td>
                    <td>{{$file->Adviser}}</td>
                    <td>{{$file->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br />
        </div>
        <center>
	    <button type="button" class="btn btn-info">Load more</button>
    </center>
</div>
@endsection