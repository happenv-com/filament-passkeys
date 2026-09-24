<?php

return [
    'label' => '設定',
    'add_label' => '新增密碼金鑰',
    'modal' => [
        'heading' => '設定密碼金鑰驗證',
        'add_heading' => '新增密碼金鑰',
        'description' => '在此裝置上登記密碼金鑰。系統會要求您使用指紋、面容、螢幕鎖定或安全金鑰。登記完成後，即可使用此密碼金鑰登入。',
        'form' => [
            'name' => [
                'label' => '密碼金鑰名稱',
                'placeholder' => '例如：MacBook Touch ID、YubiKey 5C',
                'helper_text' => '選填。留空則會以您的裝置或密碼管理工具命名。',
                'default' => '密碼金鑰',
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
        'already_registered' => [
            'title' => '此裝置已有密碼金鑰',
            'body' => '您帳戶的密碼金鑰已儲存在此裝置或密碼管理工具中。請改為在其他裝置上新增一個。',
        ],
    ],
];
