<?php

return [
    'label' => 'Kur',
    'modal' => [
        'heading' => 'Geçiş anahtarı doğrulamasını kur',
        'description' => 'Bu cihaza bir geçiş anahtarı kaydedin. Parmak izinizi, yüzünüzü, ekran kilidinizi veya bir güvenlik anahtarını kullanmanız istenecek. Kayıttan sonra bu geçiş anahtarıyla giriş yapabileceksiniz.',
        'form' => [
            'name' => [
                'label' => 'Geçiş anahtarı adı',
                'placeholder' => 'ör. MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Geçiş anahtarını kaydet',
            ],
            'errors' => [
                'failed' => 'Geçiş anahtarınız kaydedilemedi. Lütfen tekrar deneyin.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Geçiş anahtarı başarıyla kaydedildi',
        ],
    ],
];
