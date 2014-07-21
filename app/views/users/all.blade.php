@extends('layout.default')

@section('title')
    Users
@stop

@section('content')
    <h1>Users</h1>
    @foreach($users as $user)
        <li>{{ link_to_route('users.profile', $user->username, $parameters=['username' => $user->username])}}</li>
    @endforeach
@stop