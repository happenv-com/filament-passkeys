<?php

return [
    'label' => 'Kur',
    'add_label' => 'Geçiş anahtarı ekle',
    'modal' => [
        'heading' => 'Geçiş anahtarı doğrulamasını kur',
        'add_heading' => 'Bir geçiş anahtarı ekleyin',
        'description' => 'Bu cihaza bir geçiş anahtarı kaydedin. Parmak izinizi, yüzünüzü, ekran kilidinizi veya bir güvenlik anahtarını kullanmanız istenecek. Kayıttan sonra bu geçiş anahtarıyla giriş yapabileceksiniz.',
        'form' => [
            'name' => [
                'label' => 'Geçiş anahtarı adı',
                'placeholder' => 'ör. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'İsteğe bağlı. Cihazınızın veya şifre yöneticinizin adını kullanmak için boş bırakın.',
                'default' => 'Geçiş anahtarı',
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
        'already_registered' => [
            'title' => 'Bu cihazda zaten bir geçiş anahtarı var',
            'body' => 'Hesabınıza ait bir geçiş anahtarı bu cihazda veya şifre yöneticinizde zaten kayıtlı. Bunun yerine başka bir cihazdan bir tane ekleyin.',
        ],
    ],
];
