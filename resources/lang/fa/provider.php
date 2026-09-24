<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'تأیید با گذرکلید',
            'below_content' => 'از یک گذرکلید (Face ID، Touch ID، Windows Hello، Android، کلید امنیتی) برای تأیید هویت خود هنگام ورود استفاده کنید. برای هر دستگاهی که از آن وارد می‌شوید، یکی اضافه کنید.',
            'messages' => [
                'enabled' => 'فعال',
                'disabled' => 'غیرفعال',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'گذرکلید',
                'last_used_at' => 'آخرین استفاده',
                'actions' => 'اقدامات',
            ],
            'never_used' => 'هرگز',
        ],
    ],
    'login_form' => [
        'label' => 'استفاده از گذرکلید',
        'credential' => [
            'label' => 'گذرکلید',
            'messages' => [
                'invalid' => 'تأیید گذرکلید ممکن نشد. لطفاً دوباره تلاش کنید.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'تأیید با گذرکلید',
            ],
        ],
    ],
];
