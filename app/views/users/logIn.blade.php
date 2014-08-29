@extends('layout.default')

@section('title')
    Log In
@stop

@section('content')
    <h1>Log In</h1>
    {{ Form::open(['route' => 'users.postLogIn']) }}
        {{ $errors->first('incorrect_login', '<div class="general-error">:message</div>') }}
        <div>
            {{ Form::label('username', 'Username') }}
            {{ $errors->first('username', '<span class="error">:message</span>') }}
            {{ Form::text('username') }}
        </div>
        <div>
            {{ Form::label('password', 'Password') }}
            {{ $errors->first('password', '<span class="error">:message</span>') }}
            {{ Form::password('password') }}
        </div>
        {{ Form::submit('Log In') }}
    {{ Form::close() }}
@stop