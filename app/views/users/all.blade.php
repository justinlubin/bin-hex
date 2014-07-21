@extends('layout.default')

@section('title')
    All Users
@stop

@section('content')
    <h1>Users</h1>
    <ul id="all-users">
        @foreach($users as $user)
            <li>{{ link_to_route('users.profile', $user->username, $parameters=['username' => $user->username])}}</li>
        @endforeach
    </ul>
@stop