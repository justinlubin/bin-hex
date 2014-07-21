@extends('layout.default')

@section('title')
    Sign Up
@stop

@section('content')
    <h1>Sign Up</h1>
    {{ Form::open(['route' => 'users.postSignUp']) }}
        <div>
            {{ Form::label('first_name', 'First Name: ') }}
            {{ Form::text('first_name') }}
            {{ $errors->first('first_name') }}
        </div>
        <div>
            {{ Form::label('last_name', 'Last Name: ') }}
            {{ Form::text('last_name') }}
            {{ $errors->first('last_name') }}
        </div>
        <div>
            {{ Form::label('email', 'Email: ') }}
            {{ Form::text('email') }}
            {{ $errors->first('email') }}
        </div>
        <div>
            {{ Form::label('username', 'Username: ') }}
            {{ Form::text('username') }}
            {{ $errors->first('username') }}
        </div>
        <div>
            {{ Form::label('password', 'Password: ') }}
            {{ Form::password('password') }}
            {{ $errors->first('password') }}
        </div>
        <div>
            {{ Form::submit('Create User') }}
        </div>
    {{ Form::close() }}
@stop