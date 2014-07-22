@extends('layout.default')

@section('title')
    Lobby
@stop

@section('content')
    <h1>Lobby</h1>
    <h3><a href="{{ URL::route('game.getSinglePlayer') }}">Play a Single Player Game</a></h3>

    {{ Form::open(['route' => 'game.postMultiplayer']) }}
        <h3>Multiplayer Game</h3>
        <div>
            {{ Form::label('room', 'Room ') }}
            {{ Form::text('room') }}
        </div>
        {{ Form::submit('Join Room') }}
    {{ Form::close() }}
@stop