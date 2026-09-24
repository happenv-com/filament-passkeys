<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => '密碼金鑰驗證',
            'below_content' => '在此裝置上使用密碼金鑰（Face ID、Touch ID、Windows Hello、Android、安全金鑰）於登入時驗證您的身分。請為您用來登入的每台裝置新增一個。',
            'messages' => [
                'enabled' => '已啟用',
                'disabled' => '已停用',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => '密碼金鑰',
                'last_used_at' => '上次使用時間',
                'actions' => '操作',
            ],
            'never_used' => '從未使用',
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
