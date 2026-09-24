<?php

return [
    'label' => '削除',
    'modal' => [
        'heading' => 'パスキー「:name」を削除',
        'description' => 'このパスキーではログインできなくなります。他のパスキーは引き続き使用できます。',
        'description_last' => 'これは最後のパスキーです。削除すると、パスキー認証がオフになり、アカウントの追加のセキュリティ層が失われます。',
        'actions' => [
            'submit' => [
                'label' => 'パスキーを削除',
            ],
        ],
    ],
    'notifications' => [
        'removed' => [
            'title' => 'パスキーを削除しました',
        ],
    ],
];
