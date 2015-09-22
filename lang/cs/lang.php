<?php

return [
    'plugin' => [
        'name' => 'Rychlé přihlášení',
        'description' => 'Přihlášení pouze pomocí hesla'
    ],
    'logincomponent' => [
        'name' => 'Rychlé přihlášení',
        'description' => 'Formulář rychlého přihlášení',
        'redirect' => [
            'title' => 'Přesměrovat na',
            'description' => 'Název stránky pro přesměrování po úpravě údajů, přihlášení nebo registraci.'
        ],
        'visible' => [
            'title' => 'Viditelné heslo',
            'description' => 'Název stránky pro přesměrování po úpravě údajů, přihlášení nebo registraci.'
        ],
        'button' => [
            'title' => 'Text tlačítka',
            'description' => 'Text zobrazený na přihlašovacím tlačítku.'
        ]
    ],
    'form' => [
	    'wrong_code' => 'Špatně zadaný kód!',
	    'required' => 'Je nutné zadat vstupní kód.'
    ],
];
