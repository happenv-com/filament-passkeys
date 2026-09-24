<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => '通行密钥验证',
            'below_content' => '登录时使用通行密钥（Face ID、Touch ID、Windows Hello、Android、安全密钥）验证您的身份。请为您用来登录的每台设备添加一个。',
            'messages' => [
                'enabled' => '已启用',
                'disabled' => '已禁用',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => '通行密钥',
                'last_used_at' => '上次使用',
                'actions' => '操作',
            ],
            'never_used' => '从未',
        ],
    ],
    'login_form' => [
        'label' => '使用通行密钥',
        'credential' => [
            'label' => '通行密钥',
            'messages' => [
                'invalid' => '无法验证通行密钥，请重试。',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => '使用通行密钥验证',
            ],
        ],
    ],
];
