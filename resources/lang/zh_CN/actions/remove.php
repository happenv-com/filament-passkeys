<?php

return [
    'label' => '移除',
    'modal' => [
        'heading' => '移除通行密钥“:name”',
        'description' => '您将无法再使用此通行密钥登录。您的其他通行密钥仍可正常使用。',
        'description_last' => '这是您的最后一个通行密钥。移除后将关闭通行密钥验证，这会使您的账户失去一层额外的安全保护。',
        'actions' => [
            'submit' => [
                'label' => '移除通行密钥',
            ],
        ],
    ],
    'notifications' => [
        'removed' => [
            'title' => '通行密钥已移除',
        ],
    ],
];
