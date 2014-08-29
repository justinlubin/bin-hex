<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $fillable = ['first_name', 'last_name', 'email', 'username', 'password'];

	private $logInRules = [
		'username' => 'required',
		'password' => 'required'
	];

	private $signUpRules = [
		'email' => 'required|unique:users',
		'username' => 'required|unique:users',
		'password' => 'required'
	];

	private $signUpErrorMessages = [
		'unique' => 'This :attribute is already taken.'
	];

	public $errors;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function isLogInValid($data) {
		$validation = Validator::make($data, $this->logInRules);

		if($validation->passes()) {
			return true;
		} else {
			$this->errors = $validation->messages();
			return false;
		}
	}

	public function isSignUpValid($data) {
		$validation = Validator::make($data, $this->signUpRules, $this->signUpErrorMessages);

		if($validation->passes()) {
			return true;
		} else {
			$this->errors = $validation->messages();
			return false;
		}
	}
}
