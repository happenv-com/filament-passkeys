<?php

return [
    'label' => '设置',
    'add_label' => '添加通行密钥',
    'modal' => [
        'heading' => '设置通行密钥验证',
        'add_heading' => '添加通行密钥',
        'description' => '在此设备上注册通行密钥。系统将要求您使用指纹、面容、屏幕锁定或安全密钥。注册完成后，您即可使用此通行密钥登录。',
        'form' => [
            'name' => [
                'label' => '通行密钥名称',
                'placeholder' => '例如：MacBook Touch ID、YubiKey 5C',
                'helper_text' => '可选。留空则以您的设备或密码管理器命名。',
                'default' => '通行密钥',
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
        'already_registered' => [
            'title' => '此设备已有通行密钥',
            'body' => '您账户的通行密钥已保存在此设备或密码管理器中。请改为在其他设备上添加。',
        ],
    ],
];
