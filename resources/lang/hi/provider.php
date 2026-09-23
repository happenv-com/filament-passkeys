<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'पासकी सत्यापन',
            'below_content' => 'लॉग इन के दौरान अपनी पहचान सत्यापित करने के लिए इस डिवाइस पर पासकी (Face ID, Touch ID, Windows Hello, सुरक्षा कुंजी) का उपयोग करें।',
            'messages' => [
                'enabled' => 'सक्षम',
                'disabled' => 'अक्षम',
            ],
        ],
    ],
    'login_form' => [
        'label' => 'पासकी का उपयोग करें',
        'credential' => [
            'label' => 'पासकी',
            'messages' => [
                'invalid' => 'पासकी सत्यापित नहीं की जा सकी। कृपया फिर से प्रयास करें।',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'पासकी से सत्यापित करें',
            ],
        ],
    ],
];
