<?php

return [
    'label' => 'Kaldır',
    'modal' => [
        'heading' => '":name" geçiş anahtarını kaldır',
        'description' => 'Artık bu geçiş anahtarıyla giriş yapamayacaksınız. Diğer geçiş anahtarlarınız çalışmaya devam eder.',
        'description_last' => 'Bu, son geçiş anahtarınız. Onu kaldırmak geçiş anahtarı doğrulamasını kapatır ve hesabınızdan ekstra bir güvenlik katmanını kaldırır.',
        'actions' => [
            'submit' => [
                'label' => 'Geçiş anahtarını kaldır',
            ],
        ],
    ],
    'notifications' => [
        'removed' => [
            'title' => 'Geçiş anahtarı kaldırıldı',
        ],
    ],
];
