<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'パスキー認証',
            'below_content' => 'ログイン時の本人確認に、このデバイスのパスキー（Face ID、Touch ID、Windows Hello、Android、セキュリティキー）を使用します。ログインに使用するデバイスごとに追加してください。',
            'messages' => [
                'enabled' => '有効',
                'disabled' => '無効',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'パスキー',
                'last_used_at' => '最終使用日',
                'actions' => '操作',
            ],
            'never_used' => '未使用',
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
