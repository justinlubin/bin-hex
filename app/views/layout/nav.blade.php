<nav id="mainNav">
    <h3>Bin::Hex</h3>
    <ul>
        <li>{{ link_to_route('users.all', 'All Users') }}</li>
        <li>{{ link_to_route('users.leaderboard', 'Leaderboard') }}</li>
        @if(Auth::check())
            <li>{{ link_to_route('game.lobby', 'Lobby') }}</li>
            <li>{{ link_to_route('users.profile', 'Profile', $parameters = ['username' => Auth::user()->username])}}</li>
            <li>{{ link_to_route('users.getLogOut', 'Log Out') }}</li>
        @else
            <li>{{ link_to_route('users.getLogIn', 'Log In') }}</li>
            <li>{{ link_to_route('users.getSignUp', 'Sign Up') }}</li>
        @endif
    </ul>
</nav>