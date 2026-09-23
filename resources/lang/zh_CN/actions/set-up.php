<?php

return [
    'label' => '设置',
    'modal' => [
        'heading' => '设置通行密钥验证',
        'description' => '在此设备上注册通行密钥。系统将要求您使用指纹、面容、屏幕锁定或安全密钥。注册完成后，您即可使用此通行密钥登录。',
        'form' => [
            'name' => [
                'label' => '通行密钥名称',
                'placeholder' => '例如：MacBook Touch ID、YubiKey 5C',
            ],
            'submit' => [
                'label' => '注册通行密钥',
            ],
            'errors' => [
                'failed' => '无法注册您的通行密钥，请重试。',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => '通行密钥注册成功',
        ],
    ],
];
