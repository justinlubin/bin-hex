@extends('layout.default')

@section('title')
    {{ $user->username . '\'s Profile'}}
@stop

@section('extras')
    <link href='http://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet' type='text/css'>
    <script src="/lib/Chart.min.js"></script>
    <script type="text/javascript">
        (function() {
            window.onload = function() {
                var multiplayer_games = parseInt(document.getElementById("multiplayer_games").value.trim());
                var won = parseInt(document.getElementById("won").value.trim());
                var lost = parseInt(document.getElementById("lost").value.trim());

                var data = [
                    {
                        value: won,
                        color:"#F7464A",
                        highlight: "#FF5A5E",
                        label: "Won"
                    },
                    {
                        value: lost,
                        color: "#46BFBD",
                        highlight: "#5AD3D1",
                        label: "Lost"
                    }
                ];
                
                var canvas = document.getElementById("multiplayer_chart");
                var ctx = canvas.getContext("2d");
                var myNewChart = new Chart(ctx).Doughnut(data);
            }
        })();
    </script>
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
                <h2>Multiplayer</h2>
                <div id="multiplayer_chart_left">
                    <canvas id="multiplayer_chart" width="300" height="300"></canvas>
                </div>
                <div id="multiplayer_chart_right">
                    <div>
                        <div>  Won: {{ $user->won }} ({{ round($user->won/$user->multiplayer_games * 100, 2) }}%)</div>
                        <div> Lost: {{ $user->lost }} ({{ round($user->lost/$user->multiplayer_games * 100, 2) }}%)</div>
                        <div>Total: {{ $user->multiplayer_games }}</div>
                    </div>
                </div>
            </li>
        @endif
    </ul>

    <input type="hidden" id="multiplayer_games" value="{{ $user->multiplayer_games }}" />
    <input type="hidden" id="won" value="{{ $user->won }}" />
    <input type="hidden" id="lost" value="{{ $user->lost }}" />
@stop