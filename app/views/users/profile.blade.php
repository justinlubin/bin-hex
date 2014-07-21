@extends('layout.default')

@section('title')
    {{ $user->username . '\'s Profile'}}
@stop

@section('content')
    <h1>{{ $user->username }} ({{ $user->first_name . " " . $user->last_name }})</h1>
    <ul>
        <li>Email: {{ $user->email }}</li>
        <li>Games Played: {{ $user->games }}</li>
        <li>Games Won: {{ $user->won }} ({{ round($user->won/$user->games * 100, 2) }}%)</li>
        <li>Games Lost: {{ $user->lost }} ({{ round($user->lost/$user->games * 100, 2) }}%)</li>
        @if($user->best_time != 0)
            <li>Best Time: {{ Utility::formatHundredth($user->best_time) }}s</li>
        @endif
    </ul>
    <p>Back to {{ link_to_route('users.all', 'all users') }}.</p>
@stop