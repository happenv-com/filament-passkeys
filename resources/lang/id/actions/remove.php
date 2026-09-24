<?php

return [
    'label' => 'Hapus',
    'modal' => [
        'heading' => 'Hapus kunci sandi ":name"',
        'description' => 'Anda tidak akan bisa lagi masuk menggunakan kunci sandi ini. Kunci sandi Anda yang lain tetap berfungsi.',
        'description_last' => 'Ini adalah kunci sandi terakhir Anda. Menghapusnya akan menonaktifkan verifikasi kunci sandi, yang menghilangkan lapisan keamanan tambahan dari akun Anda.',
        'actions' => [
            'submit' => [
                'label' => 'Hapus kunci sandi',
            ],
        ],
    ],
    'notifications' => [
        'removed' => [
            'title' => 'Kunci sandi dihapus',
        ],
    ],
];
