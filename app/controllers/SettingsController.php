<?php

class SettingsController extends BaseController {
    protected $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function getSettings() {
        return View::make('settings');
    }

    function changeAttributes() {
        $input = Input::all();

        if(!$this->user->isInformationChangeValid($input)) {
            return Redirect::back()->withInput()->withErrors($this->user->errors);
        }

        if(trim($input['first_name']) != '') {
            Auth::user()->first_name = $input['first_name'];
        }
        if(trim($input['last_name']) != '') {
            Auth::user()->last_name = $input['last_name'];
        }
        if(trim($input['email']) != '' && $input['email']) {
            Auth::user()->email = $input['email'];
        }
        if(trim($input['username']) != '' && $input['username']) {
            Auth::user()->username = $input['username'];
        }
        if(trim($input['password'] != '')) {
            Auth::user()->password = Hash::make($input['password']);
        }

        Auth::user()->save();
        return Redirect::route('users.profile', ['username' => Auth::user()->username]);
    }
}
