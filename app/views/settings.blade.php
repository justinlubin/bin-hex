@extends('layout.default')

@section('title')
    Settings
@stop

@section('content')
    <h1>Settings</h1>
    {{ Form::open(['route' => 'settings.changeAttributes']) }}
        <p>Any information left blank will not be changed.</p>
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
        {{ Form::submit('Change Information') }}
    {{ Form::close() }}
@stop