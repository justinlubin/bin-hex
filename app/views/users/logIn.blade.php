@extends('layout.default')

@section('title')
    Log In
@stop

@section('content')
    <div class="center">
        <h1>Log In</h1>
        {{ Form::open(['route' => 'users.postLogIn']) }}
            <div>
                {{ Form::label('username', 'Username') }}
                {{ $errors->first('username', '<span class="error">:mesage</span>') }}
                {{ Form::text('username') }}
            </div>
            <div>
                {{ Form::label('password', 'Password') }}
                {{ $errors->first('password', '<span class="error">:mesage</span>') }}
                {{ Form::password('password') }}
            </div>
            {{ Form::submit('Log In') }}
        {{ Form::close() }}
    </div>
@stop