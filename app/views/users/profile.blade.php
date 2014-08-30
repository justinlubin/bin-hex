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
    <div id="profile-info">
        <table>
            <tr>
                <td>Email</td>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <td>Best Time</td>
                <td>{{ Utility::formatHundredth($user->best_time) }}s</td>
            </tr>
            <tr>
                <td>Games Played</td>
                <td>{{ $user->total_games }}</td>
            </tr>
            @if($user->multiplayer_games != 0)
            <tr>
                <td>Multiplayer</td>
                <td>
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
                </td>
            </tr>
            @endif
        </table>
    </div>

    <input type="hidden" id="multiplayer_games" value="{{ $user->multiplayer_games }}" />
    <input type="hidden" id="won" value="{{ $user->won }}" />
    <input type="hidden" id="lost" value="{{ $user->lost }}" />
@stop