<?php

return [
    'label' => '設定',
    'modal' => [
        'heading' => '設定密碼金鑰驗證',
        'description' => '在此裝置上登記密碼金鑰。系統會要求您使用指紋、面容、螢幕鎖定或安全金鑰。登記完成後，即可使用此密碼金鑰登入。',
        'form' => [
            'name' => [
                'label' => '密碼金鑰名稱',
                'placeholder' => '例如：MacBook Touch ID、YubiKey 5C',
            ],
            'submit' => [
                'label' => '登記密碼金鑰',
            ],
            'errors' => [
                'failed' => '無法登記您的密碼金鑰，請再試一次。',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => '已成功登記密碼金鑰',
        ],
    ],
];
