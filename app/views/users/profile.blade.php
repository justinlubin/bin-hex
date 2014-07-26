@extends('layout.default')

@section('title')
    {{ $user->username . '\'s Profile'}}
@stop

@section('content')
    <h1>
        {{ $user->username }}
        @if($user->first_name != "" || $user->last_name != "")
            (<!--
        -->@endif<!--
        -->@if($user->first_name != "")<!--
            -->{{ $user->first_name }}<!--
        -->@endif<!--
        -->@if($user->last_name != "")
            {{ $user->last_name }}<!--
        -->@endif<!--
        -->@if($user->first_name != "" || $user->last_name != "")<!--
            -->)
        @endif
    </h1>
    <ul id="profile-stats">
        <li>
            <h2>Email</h2>
            <div>{{ $user->email }}</div>
        </li>
        @if($user->best_time != 0)
            <li>
                <h2>Best Time</h2>
                <div>{{ Utility::formatHundredth($user->best_time) }}s</div>
            </li>
        @endif
        <li>
            <h2>Total Games Played</h2>
            <div>{{ $user->total_games }}</div>
        </li>
        @if($user->multiplayer_games != 0)
            <li>
                <h2>Multiplayer Games Played</h2>
                <div>{{ $user->multiplayer_games }}</div>
            </li>
            <li>
                <h2>Multiplayer Games Won</h2>
                <div>{{ $user->won }} ({{ round($user->won/$user->multiplayer_games * 100, 2) }}%)</div>
            </li>
            <li>
                <h2>Multiplayer Games Lost</h2>
                <div>{{ $user->lost }} ({{ round($user->lost/$user->multiplayer_games * 100, 2) }}%)</div>
            </li>
        @endif
    </ul>
@stop