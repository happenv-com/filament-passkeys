<?php

return [
    'label' => 'Käyttöönotto',
    'modal' => [
        'heading' => 'Ota pääsyavainvahvistus käyttöön',
        'description' => 'Rekisteröi pääsyavain tälle laitteelle. Sinua pyydetään käyttämään sormenjälkeä, kasvojentunnistusta, näytön lukitusta tai suojausavainta. Rekisteröinnin jälkeen voit kirjautua sisään tällä pääsyavaimella.',
        'form' => [
            'name' => [
                'label' => 'Pääsyavaimen nimi',
                'placeholder' => 'esim. MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Rekisteröi pääsyavain',
            ],
            'errors' => [
                'failed' => 'Pääsyavaimen rekisteröinti epäonnistui. Yritä uudelleen.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Pääsyavain rekisteröity onnistuneesti',
        ],
    ],
];
