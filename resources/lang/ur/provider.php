<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'پاس کی سے تصدیق',
            'below_content' => 'لاگ ان کے دوران اپنی شناخت کی تصدیق کے لیے پاس کی (Face ID، Touch ID، Windows Hello، Android، سیکیورٹی کی) استعمال کریں۔ جس ڈیوائس سے بھی سائن ان کریں، اس کے لیے ایک شامل کریں۔',
            'messages' => [
                'enabled' => 'فعال',
                'disabled' => 'غیر فعال',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'پاس کی',
                'last_used_at' => 'آخری استعمال',
                'actions' => 'اقدامات',
            ],
            'never_used' => 'کبھی نہیں',
        ],
    ],
    'login_form' => [
        'label' => 'پاس کی استعمال کریں',
        'credential' => [
            'label' => 'پاس کی',
            'messages' => [
                'invalid' => 'پاس کی کی تصدیق نہیں ہو سکی۔ براہ کرم دوبارہ کوشش کریں۔',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'پاس کی سے تصدیق کریں',
            ],
        ],
    ],
];
