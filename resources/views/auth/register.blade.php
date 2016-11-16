@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('StudentID') ? ' has-error' : '' }}">
                            <label for="StudentID" class="col-md-4 control-label">Student ID</label>

                            <div class="col-md-6">
                                <input id="StudentID" type="number" class="form-control" name="StudentID" value="{{ old('StudentID') }}" required autofocus>

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
                                <input id="FirstName" type="text" class="form-control" name="FirstName" value="{{ old('FirstName') }}" required autofocus>

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
                                <input id="MiddleName" type="text" class="form-control" name="MiddleName" value="{{ old('MiddleName') }}" required autofocus>

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
                                <input id="LastName" type="text" class="form-control" name="LastName" value="{{ old('LastName') }}" required autofocus>

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
                                <input id="Course" type="text" class="form-control" name="Course" value="{{ old('Course') }}" required autofocus>

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
                                <input id="College" type="text" class="form-control" name="College" value="{{ old('College') }}" required autofocus>

                                @if ($errors->has('College'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('College') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Email') ? ' has-error' : '' }}">
                            <label for="Email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="Email" type="email" class="form-control" name="Email" value="{{ old('Email') }}" required>

                                @if ($errors->has('Email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Password') ? ' has-error' : '' }}">
                            <label for="Password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="Password" type="password" class="form-control" name="Password" required>

                                @if ($errors->has('Password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
