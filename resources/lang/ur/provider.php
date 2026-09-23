<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'پاس کی سے تصدیق',
            'below_content' => 'لاگ ان کے دوران اپنی شناخت کی تصدیق کے لیے اس ڈیوائس پر پاس کی (Face ID، Touch ID، Windows Hello، سیکیورٹی کی) استعمال کریں۔',
            'messages' => [
                'enabled' => 'فعال',
                'disabled' => 'غیر فعال',
            ],
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
