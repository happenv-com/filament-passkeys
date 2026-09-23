<?php

return [
    'label' => '設定',
    'modal' => [
        'heading' => 'パスキー認証の設定',
        'description' => 'このデバイスにパスキーを登録します。指紋認証、顔認証、画面ロック、またはセキュリティキーの使用を求められます。登録後は、このパスキーでログインできるようになります。',
        'form' => [
            'name' => [
                'label' => 'パスキーの名前',
                'placeholder' => '例：MacBook Touch ID、YubiKey 5C',
            ],
            'submit' => [
                'label' => 'パスキーを登録',
            ],
            'errors' => [
                'failed' => 'パスキーを登録できませんでした。もう一度お試しください。',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'パスキーを登録しました',
        ],
    ],
];
