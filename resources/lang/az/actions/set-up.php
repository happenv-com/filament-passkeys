<?php

return [
    'label' => 'Quraşdır',
    'add_label' => 'Giriş açarı əlavə et',
    'modal' => [
        'heading' => 'Giriş açarı ilə doğrulamanı quraşdırın',
        'add_heading' => 'Giriş açarı əlavə edin',
        'description' => 'Bu cihazda giriş açarını qeydiyyatdan keçirin. Sizdən barmaq izinizi, üzünüzü, ekran kilidini və ya təhlükəsizlik açarını istifadə etməyiniz istəniləcək. Qeydiyyatdan sonra bu giriş açarı ilə daxil ola biləcəksiniz.',
        'form' => [
            'name' => [
                'label' => 'Giriş açarının adı',
                'placeholder' => 'məs. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'İxtiyaridir. Boş buraxsanız, cihazınızın və ya parol menecerinizin adı ilə adlandırılacaq.',
                'default' => 'Giriş açarı',
            ],
            'submit' => [
                'label' => 'Giriş açarını qeydiyyatdan keçirin',
            ],
            'errors' => [
                'failed' => 'Giriş açarınızı qeydiyyatdan keçirmək mümkün olmadı. Zəhmət olmasa, yenidən cəhd edin.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Giriş açarı uğurla qeydiyyatdan keçirildi',
        ],
        'already_registered' => [
            'title' => 'Bu cihazda artıq giriş açarı var',
            'body' => 'Hesabınız üçün giriş açarı artıq bu cihazda və ya parol menecerində saxlanılıb. Bunun əvəzinə başqa cihazdan əlavə edin.',
        ],
    ],
];
