<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'التحقق عبر مفتاح المرور',
            'below_content' => 'استخدم مفتاح مرور على هذا الجهاز (Face ID أو Touch ID أو Windows Hello أو مفتاح أمان) للتحقق من هويتك أثناء تسجيل الدخول.',
            'messages' => [
                'enabled' => 'مفعل',
                'disabled' => 'معطل',
            ],
        ],
    ],
    'login_form' => [
        'label' => 'استخدم مفتاح مرور',
        'credential' => [
            'label' => 'مفتاح المرور',
            'messages' => [
                'invalid' => 'تعذّر التحقق من مفتاح المرور. يرجى المحاولة مرة أخرى.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'التحقق باستخدام مفتاح المرور',
            ],
        ],
    ],
];
