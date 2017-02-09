@extends('layouts.app')

@section('content')
    <div class="container">
        <h2><span class="glyphicon glyphicon-list-alt"></span> Archived Files</h2>
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
                    <th>Adviser</th>
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
            </div>
            <center>
            <button type="button" class="btn btn-info">Load more</button>
        </center>
    </div>
@endsection