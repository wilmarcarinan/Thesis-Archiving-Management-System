@extends('layouts.app')

@section('content')
    @if(Auth::user()->Role == 'Admin')
        <div class="container">
            <h2><span class="glyphicon glyphicon-list-alt"></span> List All</h2>
            {{-- <div id="compress" class="jumbotron collapse col-sm-offset-3 col-sm-9">
                <form action="/compress" method="POST">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <label for="filename" style="color: white;">Enter ZIP File Name: </label>
                        <input type="text" class="form-control" name="filename" placeholder="Enter ZIP filename" style="margin-bottom: 10px">
                    </div>
                    <div class="input-group">
                        <label for="filedate" style="color:white;">Enter Batch Year: </label>
                        <input type="number" class="form-control" name="filedate" placeholder="Enter batch year" style="margin-bottom: 10px">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="compress" class="btn btn-info">    
                    </div>
                    
                </form>
            </div>
            <div class="col-sm-offset-12">
                <a href="#compress" class="btn btn-info glyphicon glyphicon-compressed" data-toggle="collapse"></a>
            </div> --}}
            <div class="jumbotron">
                <form action="/compress" method="POST">
                    {{ csrf_field() }}
                    <div class="input-group col-sm-4">
                        <label for="filename">ZIP File Name: </label>
                        <input type="text" class="form-control" name="filename" placeholder="Enter ZIP filename" style="margin-bottom: 10px">
                    </div>
                    <div class="input-group col-sm-8 col-xs-7">
                        <label for="sel1">Batch Year: </label>
                        <select class="form-control" name="filedate" style="margin-bottom: 10px">
                            <option value="">Select Year</option>
                            @foreach($years as $year)
                                <option value="{{$year['YEAR(thesis_date)']}}">{{$year['YEAR(thesis_date)']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Compress" class="btn btn-info">    
                    </div>
                </form>
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
                <br />
                </div>
                {{$files->links()}}
                <center>
                <button type="button" class="btn btn-info">Load more</button>
            </center>
        </div>
@endsection