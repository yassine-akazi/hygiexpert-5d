<?php

return [

    'unique' => 'Le champ :attribute est déjà utilisé.',

    'custom' => [
        'ice' => [
            'unique' => 'L\'ICE est déjà utilisé.',
        ],
        'phone' => [
            'unique' => 'Le numéro de téléphone est déjà utilisé.',
        ],
        'email' => [
            'unique' => 'L\'adresse e-mail est déjà utilisée.',
        ],
        'password' => [
            'required' => 'Le mot de passe est requis.',
            'min' => 'Le mot de passe doit comporter au moins :min caractères.',
        ],

    ],

    'attributes' => [
        'ice' => 'ICE',
        'phone' => 'numéro de téléphone',
        'email' => 'adresse e-mail',
        'password' => 'mot de passe',
    ],

];