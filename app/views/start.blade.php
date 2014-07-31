@extends('layout.default')

@section('title')
    Bin::Hex
@stop

@section('content')
    <h1>Welcome!</h1>
    <p>Would you like to {{ link_to_route('users.getLogIn', 'log in') }}, or {{ link_to_route('users.getSignUp', 'sign up') }}?
@stop