<?php

return [
    'plugin' => [
        'name' => 'Code login',
        'description' => 'Code/password login form'
    ],
    'logincomponent' => [
        'name' => 'Code login',
        'login_form' => 'Insert code/password login form',
        'redirect_to' => 'Redirect to',
        'redirect_to_desc' => 'Page name to redirect to after update, sign in or registration.',
    ],
    'form' => [
	    'wrong_code' => 'Wrong code!',
	    'required' => 'The :attribute field is required.',
    ],
];
