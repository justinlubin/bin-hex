<?php

class UsersController extends BaseController {
    protected $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function getAll() {
        $users = $this->user->all();
        return View::make('users.all', ['users' => $users]);
    }

    public function getProfile($username) {
        $user = $this->user->where(['username' => $username])->first();
        return View::make('users.profile', ['user' => $user]);
    }

    public function getLogIn() {
        if(Auth::check()) {
            return Redirect::route('users.profile', ['user' => Auth::user()->username]);
        } else {
            return View::make('users.logIn');
        }
    }

    public function getSignUp() {
        if(Auth::check()) {
            return Redirect::route('users.profile', ['user' => Auth::user()->username]);
        } else {
            return View::make('users.signUp');
        }
    }

    public function postLogIn() {
        $input = Input::only('username', 'password');

        if(!$this->user->isLogInValid($input)) {
            return Redirect::back()->withInput()->withErrors($this->user->errors);
        }

        if(Auth::attempt($input)) {
            return Redirect::route('users.profile', ['user' => Auth::user()->username]);
        } else {
            return "lolnope";
        }
    }

    public function postSignUp() {
        $input = Input::all();

        if(!$this->user->isSignUpValid($input)) {
            return Redirect::back()->withInput()->withErrors($this->user->errors);
        }

        $input['password'] = Hash::make($input['password']);
        $newUser = $this->user->create($input);

        Auth::login($newUser);
        return Redirect::route('users.profile', ['user' => Auth::user()->username]);
    }

    public function getLogOut() {
        Auth::logout();
        return Redirect::route('start');
    }

    function getLeaderBoard() {
        $count = Input::get('count');
        if($count == '') {
            $count = 5;
        } else {
            $count = intval($count);
        }

        $top_best_time = User::where('best_time', '!=', '0')->orderBy('best_time', 'asc')->take($count)->get();
        $top_won = User::orderBy('won', 'desc')->take($count)->get();
        $top_total_games = User::orderBy('total_games', 'desc')->take($count)->get();
        $top_singleplayer_games = User::orderBy('singleplayer_games', 'desc')->take($count)->get();
        $top_multiplayer_games = User::orderBy('multiplayer_games', 'desc')->take($count)->get();
        return View::make('users.leaderboard', [
            'top_best_time' => $top_best_time,
            'top_won' => $top_won,
            'top_total_games' => $top_total_games,
            'top_singleplayer_games' => $top_singleplayer_games,
            'top_multiplayer_games' => $top_multiplayer_games
        ]);
    }
}