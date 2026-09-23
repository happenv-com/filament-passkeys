<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => '密碼金鑰驗證',
            'below_content' => '在此裝置上使用密碼金鑰（Face ID、Touch ID、Windows Hello、安全金鑰）於登入時驗證您的身分。',
            'messages' => [
                'enabled' => '已啟用',
                'disabled' => '已停用',
            ],
        ],
    ],
    'login_form' => [
        'label' => '使用密碼金鑰',
        'credential' => [
            'label' => '密碼金鑰',
            'messages' => [
                'invalid' => '無法驗證密碼金鑰，請再試一次。',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => '使用密碼金鑰驗證',
            ],
        ],
    ],
];
