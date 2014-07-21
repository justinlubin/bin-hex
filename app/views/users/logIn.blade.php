@extends('layout.default')

@section('title')
    Log In
@stop

@section('content')
    <h1>Log In</h1>
    {{ Form::open(['route' => 'users.postLogIn']) }}
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
        {{ Form::submit('Log In') }}
    {{ Form::close() }}
@stop