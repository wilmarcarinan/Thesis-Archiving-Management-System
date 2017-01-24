@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="/css/style.css">
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2>Latest</h2>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Title</th>
              <th>Author/s</th>
              <th>Adviser</th>
              <th>Thesis Date</th>
            </tr>i
          </thead>
          <tbody>
            @foreach($files_latest as $file)
              <tr>
                <td>{{$file->FileTitle}}</td>
                <td>{{$file->Authors}}</td>
                <td>{{$file->Adviser}}</td>
                <td>{{$file->created_at}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
        {{ $files_latest->links() }}
      </div>
      <h2>Suggested</h2>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Title</th>
              <th>Author/s</th>
              <th>Adviser</th>
              <th>Thesis Date</th>
            </tr>
          </thead>
          <tbody>
              <tr></tr>
              <tr></tr>
              <tr></tr>
              <tr></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
@section('footer')

@endsection