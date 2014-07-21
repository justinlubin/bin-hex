<?php

class HomeController extends BaseController {
	public function getStart() {
		return View::make('start');
	}
}
