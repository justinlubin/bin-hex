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
        <li>Email: {{ $user->email }}</li>
        @if($user->games != 0)
            <li>Games Played: {{ $user->games }}</li>
            <li>Games Won: {{ $user->won }} ({{ round($user->won/$user->games * 100, 2) }}%)</li>
            <li>Games Lost: {{ $user->lost }} ({{ round($user->lost/$user->games * 100, 2) }}%)</li>
        @endif
        @if($user->best_time != 0)
            <li>Best Time: {{ Utility::formatHundredth($user->best_time) }}s</li>
        @endif
    </ul>
@stop