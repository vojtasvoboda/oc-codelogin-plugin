<?php

return [
    'plugin' => [
        'name' => 'Rychlé přihlášení',
        'description' => 'Přihlášení pouze pomocí hesla'
    ],
    'logincomponent' => [
        'name' => 'Rychlé přihlášení',
        'login_form' => 'Formulář rychlého přihlášení',
        'redirect_to' => 'Přesměrovat na',
        'redirect_to_desc' => 'Název stránky pro přesměrování po úpravě údajů, přihlášení nebo registraci.',
    ],
    'form' => [
	    'wrong_code' => 'Špatně zadaný kód!',
	    'required' => 'Je nutné zadat vstupní kód.',
    ],
];