<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'ការផ្ទៀងផ្ទាត់ដោយ passkey',
            'below_content' => 'ប្រើ passkey (Face ID, Touch ID, Windows Hello, Android, កូនសោសុវត្ថិភាព) ដើម្បីផ្ទៀងផ្ទាត់អត្តសញ្ញាណរបស់អ្នកអំឡុងពេលចូល។ សូមបន្ថែមមួយសម្រាប់រាល់ឧបករណ៍ដែលអ្នកប្រើសម្រាប់ចូល។',
            'messages' => [
                'enabled' => 'បានបើក',
                'disabled' => 'បានបិទ',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Passkey',
                'last_used_at' => 'ប្រើចុងក្រោយ',
                'actions' => 'សកម្មភាព',
            ],
            'never_used' => 'មិនដែល',
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
