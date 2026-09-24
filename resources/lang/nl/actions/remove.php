<?php

return [
    'label' => 'Verwijderen',
    'modal' => [
        'heading' => 'Toegangssleutel ":name" verwijderen',
        'description' => 'Je kunt niet meer inloggen met deze toegangssleutel. Je andere toegangssleutels blijven werken.',
        'description_last' => 'Dit is je laatste toegangssleutel. Als je deze verwijdert, wordt verificatie met toegangssleutel uitgeschakeld, waardoor een extra beveiligingslaag van je account verdwijnt.',
        'actions' => [
            'submit' => [
                'label' => 'Toegangssleutel verwijderen',
            ],
        ],
    ],
    'notifications' => [
        'removed' => [
            'title' => 'Toegangssleutel verwijderd',
        ],
    ],
];
