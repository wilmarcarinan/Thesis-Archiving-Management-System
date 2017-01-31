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
                        <th>Thesis Date</th>
                        <th><span class="glyphicon glyphicon-eye-open"></span></th>
                        <th><span class="glyphicon glyphicon-star-empty"></span></th>
                        @if(Auth::user()->Role == 'Admin')
                            <th>Status</th>
                            <th></th>
                        @endif
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