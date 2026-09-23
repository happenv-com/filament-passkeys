<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'パスキー認証',
            'below_content' => 'ログイン時の本人確認に、このデバイスのパスキー（Face ID、Touch ID、Windows Hello、セキュリティキー）を使用します。',
            'messages' => [
                'enabled' => '有効',
                'disabled' => '無効',
            ],
        ],
    ],
    'login_form' => [
        'label' => 'パスキーを使用',
        'credential' => [
            'label' => 'パスキー',
            'messages' => [
                'invalid' => 'パスキーを確認できませんでした。もう一度お試しください。',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'パスキーで認証',
            ],
        ],
    ],
];
