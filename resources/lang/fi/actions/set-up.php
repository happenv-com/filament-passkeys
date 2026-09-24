<?php

return [
    'label' => 'Käyttöönotto',
    'add_label' => 'Lisää pääsyavain',
    'modal' => [
        'heading' => 'Ota pääsyavainvahvistus käyttöön',
        'add_heading' => 'Lisää pääsyavain',
        'description' => 'Rekisteröi pääsyavain tälle laitteelle. Sinua pyydetään käyttämään sormenjälkeä, kasvojentunnistusta, näytön lukitusta tai suojausavainta. Rekisteröinnin jälkeen voit kirjautua sisään tällä pääsyavaimella.',
        'form' => [
            'name' => [
                'label' => 'Pääsyavaimen nimi',
                'placeholder' => 'esim. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Valinnainen. Jätä tyhjäksi, niin se nimetään laitteesi tai salasananhallintaohjelmasi mukaan.',
                'default' => 'Pääsyavain',
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
        'already_registered' => [
            'title' => 'Tällä laitteella on jo pääsyavain',
            'body' => 'Tiliäsi varten tallennettu pääsyavain on jo tallennettu tähän laitteeseen tai salasananhallintaan. Lisää pääsyavain sen sijaan toiselta laitteelta.',
        ],
    ],
];
