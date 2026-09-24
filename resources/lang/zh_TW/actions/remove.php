<?php

return [
    'label' => '移除',
    'modal' => [
        'heading' => '移除密碼金鑰「:name」',
        'description' => '您將無法再使用此密碼金鑰登入。您的其他密碼金鑰仍可繼續使用。',
        'description_last' => '這是您最後一個密碼金鑰。移除後將關閉密碼金鑰驗證，這會移除帳戶的額外安全防護層。',
        'actions' => [
            'submit' => [
                'label' => '移除密碼金鑰',
            ],
        ],
    ],
    'notifications' => [
        'removed' => [
            'title' => '密碼金鑰已移除',
        ],
    ],
];
