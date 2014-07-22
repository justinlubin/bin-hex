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
        Auth::user()->total_games += 1;

        $is_multiplayer= Input::get('is_multiplayer');
        if($is_multiplayer) {
            Auth::user()->multiplayer_games += 1;
            $win = Input::get('win');
            if($win) {
                Auth::user()->won += 1;
            } else {
                Auth::user()->lost += 1;
            }
        } else {
            Auth::user()->singleplayer_games += 1;
        }

        $time = Input::get('time');
        if(Auth::user()->best_time == 0 || $time < Auth::user()->best_time) {
            Auth::user()->best_time = $time;
        }

        Auth::user()->save();
        return View::make('game.lobby');
    }
}
