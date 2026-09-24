<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'पासकी सत्यापन',
            'below_content' => 'लॉग इन के दौरान अपनी पहचान सत्यापित करने के लिए पासकी (Face ID, Touch ID, Windows Hello, Android, सुरक्षा कुंजी) का उपयोग करें। जिस भी डिवाइस से आप साइन इन करते हैं, उसके लिए एक पासकी जोड़ें।',
            'messages' => [
                'enabled' => 'सक्षम',
                'disabled' => 'अक्षम',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'पासकी',
                'last_used_at' => 'अंतिम बार उपयोग',
                'actions' => 'कार्रवाइयां',
            ],
            'never_used' => 'कभी नहीं',
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
