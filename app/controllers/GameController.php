<?php

class GameController extends BaseController {
    public function getLobby() {
        return View::make('game.lobby');
    }

    public function getSinglePlayerGame() {
        return View::make('game.singleplayer');
    }

    public function postMultiPlayerGame() {
        $room = Input::get('room');
        return View::make('game.multiplayer', ['username' => Auth::user()->username, 'room' => $room]);
    }

    public function postUpdate() {
        Auth::user()->games += 1;

        $win = Input::get('win');
        if($win == "true") {
            $time = Input::get('time');
            if(Auth::user()->best_time == 0 || $time < Auth::user()->best_time) {
                Auth::user()->best_time = $time;
            }
            Auth::user()->won += 1;
        } else {
            Auth::user()->lost += 1;
        }

        Auth::user()->save();
        return Auth::user();
    }
}
