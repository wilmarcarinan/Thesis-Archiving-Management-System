@extends('layouts.app')

@section('content')
<div class="container" style="padding-top: 50px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if(session('status'))
                <div class="alert alert-success">
                  <li style="list-style: none;">{{session('status')}}</li>
                </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #64b5f6;color:#fff;">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('StudentID') ? ' has-error' : '' }}">
                            <label for="StudentID" class="col-md-4 control-label">Student ID</label>

                            <div class="col-md-6">
                                <input id="StudentID" type="number" class="form-control" name="StudentID" value="{{ old('StudentID') }}">

                                @if ($errors->has('StudentID'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('StudentID') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('FirstName') ? ' has-error' : '' }}">
                            <label for="FirstName" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="FirstName" type="text" class="form-control" name="FirstName" value="{{ old('FirstName') }}">

                                @if ($errors->has('FirstName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('FirstName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('MiddleName') ? ' has-error' : '' }}">
                            <label for="MiddleName" class="col-md-4 control-label">Middle Name</label>

                            <div class="col-md-6">
                                <input id="MiddleName" type="text" class="form-control" name="MiddleName" value="{{ old('MiddleName') }}">

                                @if ($errors->has('MiddleName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('MiddleName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('LastName') ? ' has-error' : '' }}">
                            <label for="LastName" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="LastName" type="text" class="form-control" name="LastName" value="{{ old('LastName') }}">

                                @if ($errors->has('LastName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('LastName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Course') ? ' has-error' : '' }}">
                            <label for="Course" class="col-md-4 control-label">Course</label>

                            <div class="col-md-6">
                                <select class="form-control" name="Course">
                                    <option value="">Select Course</option>
                                    {{-- @foreach($courses as $course)
                                        <option value="{{$course->Course}}">{{$course->Course}}</option>
                                    @endforeach --}}
                                    <option value="BSIT">BSIT</option>
                                    <option value="BSIS">BSIS</option>
                                    <option value="BSCS">BSCS</option>
                                </select>
                                {{-- <input id="Course" type="text" class="form-control" name="Course" value="{{ old('Course') }}"> --}}

                                @if ($errors->has('Course'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Course') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('College') ? ' has-error' : '' }}">
                            <label for="College" class="col-md-4 control-label">College</label>

                            <div class="col-md-6">
                                <input id="College" type="text" class="form-control" name="College" value="{{ old('College') }}">

                                @if ($errors->has('College'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('College') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                                <a class="btn btn-primary" href="{{ url('/login') }}">
                                    Login
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
