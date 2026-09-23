<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'पासकी प्रमाणीकरण',
            'below_content' => 'लग इन गर्दा आफ्नो पहिचान प्रमाणित गर्न यो यन्त्रमा पासकी (Face ID, Touch ID, Windows Hello, सुरक्षा साँचो) प्रयोग गर्नुहोस्।',
            'messages' => [
                'enabled' => 'सक्षम',
                'disabled' => 'असक्षम',
            ],
        ],
    ],
    'login_form' => [
        'label' => 'पासकी प्रयोग गर्नुहोस्',
        'credential' => [
            'label' => 'पासकी',
            'messages' => [
                'invalid' => 'पासकी प्रमाणित गर्न सकिएन। कृपया फेरि प्रयास गर्नुहोस्।',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'पासकीमार्फत प्रमाणित गर्नुहोस्',
            ],
        ],
    ],
];
