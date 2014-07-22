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
    <ul id="profile-stats" class="card-wrapper">
        <li>Email: {{ $user->email }}</li>
        <li>Games Played: {{ $user->total_games }}</li>
        @if($user->multiplayer_games != 0)
            <li>Multiplayer Games Won: {{ $user->won }} ({{ round($user->won/$user->multiplayer_games * 100, 2) }}%)</li>
            <li>Multiplayer Games Lost: {{ $user->lost }} ({{ round($user->lost/$user->multiplayer_games * 100, 2) }}%)</li>
        @endif
        @if($user->best_time != 0)
            <li>Best Time: {{ Utility::formatHundredth($user->best_time) }}s</li>
        @endif
    </ul>
    <p>Back to {{ link_to_route('users.all', 'all users') }}.</p>
@stop