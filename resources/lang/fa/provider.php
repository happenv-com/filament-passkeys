<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'تأیید با گذرکلید',
            'below_content' => 'از گذرکلید روی این دستگاه (Face ID، Touch ID، Windows Hello، کلید امنیتی) برای تأیید هویت خود هنگام ورود استفاده کنید.',
            'messages' => [
                'enabled' => 'فعال',
                'disabled' => 'غیرفعال',
            ],
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
