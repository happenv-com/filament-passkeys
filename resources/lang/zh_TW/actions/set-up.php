<?php

return [
    'label' => '設定',
    'add_label' => '新增密碼金鑰',
    'modal' => [
        'heading' => '設定密碼金鑰驗證',
        'add_heading' => '新增密碼金鑰',
        'description' => '在此裝置上註冊密碼金鑰。系統會要求您使用指紋、臉部、螢幕鎖定或安全金鑰。註冊完成後，即可使用此密碼金鑰登入。',
        'form' => [
            'name' => [
                'label' => '密碼金鑰名稱',
                'placeholder' => '例如：MacBook Touch ID、YubiKey 5C',
                'helper_text' => '選填。留空將以您的裝置或密碼管理工具的名稱命名。',
                'default' => '密碼金鑰',
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
        'already_registered' => [
            'title' => '此裝置已有密碼金鑰',
            'body' => '您帳戶的密碼金鑰已儲存在此裝置或密碼管理工具中。請改從其他裝置新增。',
        ],
    ],
];
