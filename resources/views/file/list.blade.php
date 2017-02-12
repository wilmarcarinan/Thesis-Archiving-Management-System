@extends('layouts.app')

@section('content')
    @if(Auth::user()->Role == 'Admin')
        <div class="container">
            <div class=" col-sm-2"><span class="glyphicon glyphicon-list-alt"></span> List All</div>
            <div id="compress" class="collapse col-sm-offset-3 col-sm-9">
                <form action="/compress" method="POST">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input type="text" class="form-control" name="filename" placeholder="Enter ZIP filename">
                        <input type="number" class="form-control" name="filedate" placeholder="Enter batch year">
                    </div>
                    <input type="submit" value="compress" class="btn btn-info">
                </form>
            </div>
            <div class="col-sm-offset-12">
                <a href="#compress" class="btn btn-info glyphicon glyphicon-compressed" data-toggle="collapse"></a>
            </div>
    @else
        <div class="container">
            <h2><span class="glyphicon glyphicon-list-alt"></span> List All</h2>
    @endif
            <div class="table-responsive">          
                <table class="table">
                    <thead>
                      <tr>
                        @if(Auth::user()->Role <> 'Admin')
                            <th></th>
                            <th></th>
                        @endif
                        <th><span class="glyphicon glyphicon-sort-by-order"></span></th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Author/s</th>
                        <th>Course</th>
                        <th>Adviser</th>
                        <th>Thesis Date</th>
                        @if(Auth::user()->Role == 'Admin')
                            <th>Status</th>
                        @endif
                        <th><span class="glyphicon glyphicon-eye-open"></span></th>
                        <th><span class="glyphicon glyphicon-star-empty"></span></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        @include('file.table-contents')
                    </tbody>
                </table>
                {{$files->links()}}
                <br />
                </div>
                <center>
                <button type="button" class="btn btn-info">Load more</button>
            </center>
        </div>
@endsection