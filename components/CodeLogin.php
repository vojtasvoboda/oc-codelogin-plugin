<?php namespace VojtaSvoboda\CodeLogin\Components;

use Auth;
use Event;
use Exception;
use Flash;
use Input;
use Redirect;
use Request;
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
            'description' => 'vojtasvoboda.codelogin::lang.logincomponent.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'redirect' => [
                'title'       => 'vojtasvoboda.codelogin::lang.logincomponent.redirect.title',
                'description' => 'vojtasvoboda.codelogin::lang.logincomponent.redirect.description',
                'type'        => 'dropdown',
                'default'     => ''
            ],
            'visible' => [
                'title'       => 'vojtasvoboda.codelogin::lang.logincomponent.visible.title',
                'description' => 'vojtasvoboda.codelogin::lang.logincomponent.visible.description',
                'type'        => 'checkbox',
                'default'     => false
            ],
            'button' => [
                'title'       => 'vojtasvoboda.codelogin::lang.logincomponent.button.title',
                'description' => 'vojtasvoboda.codelogin::lang.logincomponent.button.description',
                'type'        => 'string',
                'default'     => 'enter'
            ]
        ];
    }

    public function getRedirectOptions()
    {
        $default = [
            '' => '- none -'
        ];
        $pages = Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');

        return $default + $pages;
    }

    /**
     * Executed when this component is bound to a page or layout.
     */
    public function onRun()
    {
        $this->page['visible'] = $this->property('visible');
        $this->page['button'] = $this->property('button');
    }

    /**
     * Sign in the user
     */
    public function onCodesignin()
    {
        try {
            return $this->doSignin();

        } catch (Exception $ex) {
            if (Request::ajax()) {
                throw $ex;
            }
            Flash::error($ex->getMessage());
        }
    }

    private function doSignin()
    {
        /*
         * Validate input
         */
        $data = post();

        $rules = [];
        $rules['code'] = 'required|min:2';

        $messages = [];
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
         * Event just for backward compatibility. It's more then recommand use
         * standard rainlab.user.login event - see readme.
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
