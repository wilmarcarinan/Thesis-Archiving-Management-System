@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron">          
            <h2><span class="glyphicon glyphicon-list-alt"></span> Archived Files</h2>
            <table class="table" id="archived-table">
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
                    <th>Title</th>
                    <th>Tags</th>
                    {{-- <th>Author/s</th> --}}
                    {{-- <th>Adviser</th> --}}
                    <th>Course</th>
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
            <br />
            @if(!$files->count())
                <center>
                    <h3>No Archived Files</h3>
                </center>
            @endif
        </div>
        {{-- <center>
            <button type="button" class="btn btn-info">Load more</button>
        </center> --}}
    </div>
@endsection

@section('script-section')
    <script>
        $(document).ready(function(){
            $('#archived-table').DataTable({
                responsive: true
            });
        });
    </script>
@endsection