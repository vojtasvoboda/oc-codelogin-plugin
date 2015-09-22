<?php

namespace VojtaSvoboda\CodeLogin\Components;

use Auth;
use Event;
use Flash;
use Input;
use Redirect;
use Validator;
use ValidationException;
use ApplicationException;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use VojtaSvoboda\CodeLogin\Repositories\UserRepository;

class CodeLogin extends ComponentBase
{
	public function componentDetails()
	{
		return [
			'name'        => 'vojtasvoboda.codelogin::lang.logincomponent.name',
			'description' => 'vojtasvoboda.codelogin::lang.logincomponent.login_form'
		];
	}

	public function defineProperties()
	{
		return [
			'redirect' => [
				'title'       => 'vojtasvoboda.codelogin::lang.logincomponent.redirect_to',
				'description' => 'vojtasvoboda.codelogin::lang.logincomponent.redirect_to_desc',
				'type'        => 'dropdown',
				'default'     => ''
			]
		];
	}

	public function getRedirectOptions()
	{
		return [''=>'- none -'] + Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
	}

	/**
	 * Executed when this component is bound to a page or layout.
	 */
	public function onRun()
	{
		$this->page['user'] = $this->user();
	}

	/**
	 * Returns the logged in user, if available
	 */
	public function user()
	{
		if (!Auth::check()) {
			return null;
		}

		return Auth::getUser();
	}

	/**
	 * Sign in the user
	 */
	public function onCodesignin()
	{
		/*
		 * Validate input
		 */
		$data = post();

		$rules = [];
		$rules['code'] = 'required|min:2';
		$messages['required'] = trans('vojtasvoboda.codelogin::lang.form.required');

		$validation = Validator::make($data, $rules, $messages);
		if ($validation->fails()) {
			throw new ValidationException($validation);
		}

		/*
		 * Find user by password
		 */
		$users = new UserRepository();
		$userToLog = $users->getUserByPassword(array_get($data, 'code'));
		if ($userToLog === null) {
			$exception = new ValidationException([trans('vojtasvoboda.codelogin::lang.form.wrong_code')]);
			throw $exception;
		}

		/*
		 * Authenticate user
		 */
		$remember = true;
		$user = Auth::authenticate([
			'login' => $userToLog->email,
			'password' => array_get($data, 'code')
		], $remember);

		/*
		 * After login event
		 */
		Event::fire('vojtasvoboda.codelogin.afterlogin', [$user]);

		/*
		 * Redirect to the intended page after successful sign in
		 */
		$redirectUrl = $this->pageUrl($this->property('redirect'));

		if ($redirectUrl = post('redirect', $redirectUrl)) {
			return Redirect::intended($redirectUrl);
		}
	}

}
