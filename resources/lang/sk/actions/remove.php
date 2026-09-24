<?php

return [
    'label' => 'Odstrániť',
    'modal' => [
        'heading' => 'Odstrániť prístupový kľúč ":name"',
        'description' => 'S týmto prístupovým kľúčom sa už nebudete môcť prihlásiť. Vaše ostatné prístupové kľúče budú naďalej fungovať.',
        'description_last' => 'Toto je váš posledný prístupový kľúč. Jeho odstránením sa vypne overenie prístupovým kľúčom, čím sa z vášho účtu odstráni ďalšia vrstva zabezpečenia.',
        'actions' => [
            'submit' => [
                'label' => 'Odstrániť prístupový kľúč',
            ],
        ],
    ],
    'notifications' => [
        'removed' => [
            'title' => 'Prístupový kľúč bol odstránený',
        ],
    ],
];
