<?php

class HomeController extends BaseController {
	public function getStart() {
        if(Auth::check()) {
            return Redirect::route('users.profile', ['username' => Auth::user()->username]);
        } else {
            return View::make('start');
        }
	}
}
