<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'ការផ្ទៀងផ្ទាត់ដោយ passkey',
            'below_content' => 'ប្រើ passkey នៅលើឧបករណ៍នេះ (Face ID, Touch ID, Windows Hello, កូនសោសុវត្ថិភាព) ដើម្បីផ្ទៀងផ្ទាត់អត្តសញ្ញាណរបស់អ្នកអំឡុងពេលចូល។',
            'messages' => [
                'enabled' => 'បានបើក',
                'disabled' => 'បានបិទ',
            ],
        ],
    ],
    'login_form' => [
        'label' => 'ប្រើ passkey',
        'credential' => [
            'label' => 'passkey',
            'messages' => [
                'invalid' => 'មិនអាចផ្ទៀងផ្ទាត់ passkey បានទេ។ សូមព្យាយាមម្តងទៀត។',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'ផ្ទៀងផ្ទាត់ដោយប្រើ passkey',
            ],
        ],
    ],
];
