<?php

return [
    'label' => 'Poista',
    'modal' => [
        'heading' => 'Poista pääsyavain ":name"',
        'description' => 'Et voi enää kirjautua sisään tällä pääsyavaimella. Muut pääsyavaimesi toimivat edelleen.',
        'description_last' => 'Tämä on viimeinen pääsyavaimesi. Sen poistaminen poistaa pääsyavainvahvistuksen käytöstä, mikä poistaa tililtäsi ylimääräisen suojauskerroksen.',
        'actions' => [
            'submit' => [
                'label' => 'Poista pääsyavain',
            ],
        ],
    ],
    'notifications' => [
        'removed' => [
            'title' => 'Pääsyavain poistettu',
        ],
    ],
];
