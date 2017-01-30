@extends('layouts.app')

@section('content')
    @if(Auth::user()->Role == 'Admin')
        <div class="container" style="margin-left: 225px">
    @else
        <div class="container">
    @endif
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
                            <td>
                                @if(Request::server('SERVER_NAME') <> '127.0.0.1')
                                    <a href="/pdf.js/web/viewer.html?file=http://{{ Request::server('SERVER_NAME').$file->FilePath }}" target="_blank">
                                @else
                                    <a href="/pdf.js/web/viewer.html?file=http://localhost:8000{{$file->FilePath }}" target="_blank">
                                @endif
                                {{$file->FileTitle}}
                            </td>
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