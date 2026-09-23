<?php

return [
    'label' => '設定',
    'modal' => [
        'heading' => '設定密碼金鑰驗證',
        'description' => '在此裝置上註冊密碼金鑰。系統會要求您使用指紋、臉部、螢幕鎖定或安全金鑰。註冊完成後，即可使用此密碼金鑰登入。',
        'form' => [
            'name' => [
                'label' => '密碼金鑰名稱',
                'placeholder' => '例如：MacBook Touch ID、YubiKey 5C',
            ],
            'submit' => [
                'label' => '註冊密碼金鑰',
            ],
            'errors' => [
                'failed' => '無法註冊您的密碼金鑰，請再試一次。',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => '密碼金鑰註冊成功',
        ],
    ],
];
