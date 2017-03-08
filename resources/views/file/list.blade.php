@extends('layouts.app')

@section('content')
    @if(Auth::user()->Role == 'Admin')
        <div class="container">
            <h2><span class="glyphicon glyphicon-list-alt"></span> List All</h2>
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
                        <input type="submit" value="Backup All Files" name="backup" class="btn btn-info">
                    </div>
                </form>
            </div>

    @else
        <div class="container">
            <h2><span class="glyphicon glyphicon-list-alt"></span> List All</h2>
    @endif
        @if(Auth::user()->Role == 'Admin')
            <div class="jumbotron">
        @else
            <div>
        @endif
                <table id="files-list" class="table" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        @if(Auth::user()->Role <> 'Admin')
                            <th></th>
                            <th></th>
                            <th></th>
                        @else
                            <th></th>
                            <th></th>
                        @endif
                        <th class="hidden">Abstract</th>
                        <th class="hidden">Authors</th>
                        <th class="hidden">Adviser</th>
                        <th>Title</th>
                        <th>Subject Area</th>
                        <th>Tags</th>
                        {{-- <th>Author/s</th> --}}
                        <th>Course</th>
                        {{-- <th>Adviser</th> --}}
                        <th>Thesis Date</th>
                        @if(Auth::user()->Role == 'Admin')
                            <th>Status</th>
                        @endif
                        <th><span class="glyphicon glyphicon-eye-open"></span></th>
                        <th><span class="glyphicon glyphicon-star-empty"></span></th>
                      </tr>
                    </thead>
                    <tbody>
                        @include('file.table-contents')
                    </tbody>
                </table>
            </div>
            {{-- <center> --}}
                {{-- <button type="button" class="btn btn-info">Load more</button> --}}
            {{-- </center> --}}
        </div>
@endsection

@section('script-section')
    <script>
        $(document).ready(function(){
            $('#files-list').DataTable({
                responsive: true
            });
        });
    </script>
@endsection