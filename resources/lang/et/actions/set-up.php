<?php

return [
    'label' => 'Seadistamine',
    'modal' => [
        'heading' => 'Seadistage pääsuvõtmega kinnitamine',
        'description' => 'Registreerige selles seadmes pääsuvõti. Teil palutakse kasutada sõrmejälge, näotuvastust, ekraanilukku või turvavõtit. Pärast registreerimist saate selle pääsuvõtmega sisse logida.',
        'form' => [
            'name' => [
                'label' => 'Pääsuvõtme nimi',
                'placeholder' => 'nt MacBook Touch ID, YubiKey 5C',
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
    ],
];
