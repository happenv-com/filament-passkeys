<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => '通行密钥验证',
            'below_content' => '登录时使用此设备上的通行密钥（Face ID、Touch ID、Windows Hello、安全密钥）验证您的身份。',
            'messages' => [
                'enabled' => '已启用',
                'disabled' => '已禁用',
            ],
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
