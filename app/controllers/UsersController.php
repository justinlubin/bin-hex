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

    public function create() {
        if(Auth::check()) {
            return Redirect::route('users.show', ['user' => Auth::user()->username]);
        } else {
            return View::make('users.create');
        }
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
}