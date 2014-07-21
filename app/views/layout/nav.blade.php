<nav style="border-bottom: 1px solid black;">
    <h3>Bin:Hex</h3>
    <ul>
        @if(Auth::check())
            <li>{{ link_to_route('game.lobby', 'Lobby') }}</li>
            <li>{{ link_to_route('users.profile', 'Profile', $parameters=['username' => Auth::user()->username])}}</li>
            <li>{{ link_to_route('users.getLogOut', 'Log Out') }}</li>
        @else
            <li>{{ link_to_route('users.getLogIn', 'Log In') }}</li>
            <li>{{ link_to_route('users.getSignUp', 'Sign Up') }}</li>
        @endif
    </ul>
</nav>