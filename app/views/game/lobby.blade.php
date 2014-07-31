@extends('layout.default')

@section('title')
    Game Lobby
@stop

@section('content')
    <h1>Game Lobby</h1>
    <div id="singleplayer"><h3>{{ link_to_route('game.getSinglePlayer', 'Play a Single Player Game') }}</h3></div>

    {{ Form::open(['route' => 'game.postMultiplayer']) }}
        <h3>Multiplayer Game</h3>
        <div>
            {{ Form::label('room', 'Room ') }}
            {{ Form::text('room') }}
        </div>
        {{ Form::submit('Join Room') }}
    {{ Form::close() }}
@stop