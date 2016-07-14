<?php namespace VojtaSvoboda\CodeLogin\Repositories;

use Auth;
use October\Rain\Auth\AuthException;
use RainLab\User\Models\User;

class UserRepository
{
	/**
	 * Get all users
	 *
	 * @return mixed
	 */
	public function getAllUsers()
	{
		return User::where('is_activated', true)->get();
	}

	/**
	 * Returns user by password
	 *
	 * @param $password
	 *
	 * @return User|null
	 */
	public function getUserByPassword($password)
	{
		foreach ($this->getAllUsers() as $user) {

			try {
				$user = Auth::findUserByCredentials([
					'email' => $user->email,
					'password' => $password,
				]);

				return $user;

			} catch(AuthException $e) {
				$user = null;
			}

		}

		return null;
	}
}
