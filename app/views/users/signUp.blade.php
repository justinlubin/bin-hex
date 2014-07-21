@extends('layout.default')

@section('title')
    Sign Up
@stop

@section('content')
    <div class="center">
        <h1>Sign Up</h1>
        {{ Form::open(['route' => 'users.postSignUp']) }}
            <div>
                {{ Form::label('first_name', 'First Name') }}
                {{ $errors->first('first_name', '<span class="error">:message</span>') }}
                {{ Form::text('first_name') }}
            </div>
            <div>
                {{ Form::label('last_name', 'Last Name') }}
                {{ $errors->first('last_name', '<span class="error">:message</span>') }}
                {{ Form::text('last_name') }}
            </div>
            <div>
                {{ Form::label('email', 'Email') }}
                {{ $errors->first('email', '<span class="error">:message</span>') }}
                {{ Form::text('email') }}
            </div>
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
            {{ Form::submit('Sign Up') }}
        {{ Form::close() }}
    </div>
@stop