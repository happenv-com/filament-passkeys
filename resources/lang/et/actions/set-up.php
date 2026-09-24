<?php

return [
    'label' => 'Seadistamine',
    'add_label' => 'Lisa pääsuvõti',
    'modal' => [
        'heading' => 'Seadistage pääsuvõtmega kinnitamine',
        'add_heading' => 'Lisage pääsuvõti',
        'description' => 'Registreerige selles seadmes pääsuvõti. Teil palutakse kasutada sõrmejälge, näotuvastust, ekraanilukku või turvavõtit. Pärast registreerimist saate selle pääsuvõtmega sisse logida.',
        'form' => [
            'name' => [
                'label' => 'Pääsuvõtme nimi',
                'placeholder' => 'nt MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Valikuline. Jätke tühjaks, et nimetada see teie seadme või paroolihalduri järgi.',
                'default' => 'Pääsuvõti',
            ],
            'submit' => [
                'label' => 'Registreeri pääsuvõti',
            ],
            'errors' => [
                'failed' => 'Teie pääsuvõtit ei õnnestunud registreerida. Palun proovige uuesti.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Pääsuvõti on edukalt registreeritud',
        ],
        'already_registered' => [
            'title' => 'Sellel seadmel on juba pääsuvõti',
            'body' => 'Teie konto pääsuvõti on juba salvestatud sellesse seadmesse või paroolihaldurisse. Lisage see hoopis mõnest teisest seadmest.',
        ],
    ],
];
