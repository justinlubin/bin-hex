@extends('layout.default')

@section('title')
    Lobby
@stop

@section('content')
    <h1>Lobby</h1>
    <ul>
        <li>{{ link_to_route('game.getSingleplayer', 'Single Player Game') }}</li>
    </ul>

    {{ Form::open(['route' => 'game.postMultiplayer']) }}
        <div>
            {{ Form::label('room', 'Room: ') }}
            {{ Form::text('room') }}
        </div>
        {{ Form::submit('Multiplayer Game') }}
    {{ Form::close() }}
@stop