<?php

return [
    'plugin' => [
        'name' => 'Kennwort Schutz',
        'description' => 'Kennwort Schutz Anmelde-Formular'
    ],
    'logincomponent' => [
        'name' => 'Kennwort Schutz',
        'description' => 'Kennwort Schutz Anmelde-Formular hinzufügen',
        'redirect' => [
            'title' => 'Umleiten nach',
            'description' => 'Seitenname für die Umleitung nach dem Update, Anmeldung oder Registration.'                   
        ],
        'visible' => [
            'title' => 'Kennwort sichtbar',
            'description' => 'Wenn aktiviert, Kennwort sichtbar (Verwendet Eingabetyp Text)'
        ],
        'button' => [
            'title' => 'Button Titel',
            'description' => 'Anmelde Button Text.'
        ]
    ],
    'form' => [
	    'wrong_code' => 'Falsches Kennwort!',
	    'required' => 'Das :attribute Feld ist notwendig.'
    ],
];
