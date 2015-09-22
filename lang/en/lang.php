<?php

return [
    'plugin' => [
        'name' => 'Code login',
        'description' => 'Code/password login form'
    ],
    'logincomponent' => [
        'name' => 'Code login',
        'description' => 'Insert code/password login form',
        'redirect' => [
            'title' => 'Redirect to',
            'description' => 'Page name to redirect to after update, sign in or registration.',
        ],
        'visible' => [
            'title' => 'Code/password visible',
            'description' => 'When checked, inserted password will be visible (input type text used).'
        ],
        'button' => [
            'title' => 'Button label',
            'description' => 'String which will be shown at login button.'
        ]
    ],
    'form' => [
	    'wrong_code' => 'Wrong code!',
	    'required' => 'The :attribute field is required.'
    ],
];
