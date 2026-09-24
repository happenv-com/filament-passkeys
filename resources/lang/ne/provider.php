<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'पासकी प्रमाणीकरण',
            'below_content' => 'लग इन गर्दा आफ्नो पहिचान प्रमाणित गर्न पासकी (Face ID, Touch ID, Windows Hello, Android, सुरक्षा साँचो) प्रयोग गर्नुहोस्। तपाईँ साइन इन गर्ने प्रत्येक यन्त्रको लागि एउटा थप्नुहोस्।',
            'messages' => [
                'enabled' => 'सक्षम',
                'disabled' => 'असक्षम',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'पासकी',
                'last_used_at' => 'पछिल्लो पटक प्रयोग गरिएको',
                'actions' => 'कार्यहरू',
            ],
            'never_used' => 'कहिल्यै',
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
