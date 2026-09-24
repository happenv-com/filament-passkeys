<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'التحقق عبر مفتاح المرور',
            'below_content' => 'استخدم مفتاح مرور (Face ID أو Touch ID أو Windows Hello أو Android أو مفتاح أمان) للتحقق من هويتك أثناء تسجيل الدخول. أضف مفتاحًا لكل جهاز تسجّل الدخول منه.',
            'messages' => [
                'enabled' => 'مفعل',
                'disabled' => 'معطل',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'مفتاح المرور',
                'last_used_at' => 'آخر استخدام',
                'actions' => 'الإجراءات',
            ],
            'never_used' => 'أبدًا',
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
