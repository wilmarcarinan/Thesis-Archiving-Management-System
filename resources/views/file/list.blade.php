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
                <th>Date</th>
                <th>Adviser</th>
                <th>Course</th>
                <th><span class="glyphicon glyphicon-eye-open"></span></th>
                <th><span class="glyphicon glyphicon-star-empty"></span></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <br />
        </div>
        <center>
	    <button type="button" class="btn btn-info">Load more</button>
    </center>
</div>
@endsection