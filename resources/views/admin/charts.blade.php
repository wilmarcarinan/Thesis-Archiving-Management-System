@extends('layouts.app')

@section('header')
    {!! Charts::assets() !!}
@endsection

@section('content')
<center>
    {!! $chart->render() !!}
</center>
@endsection