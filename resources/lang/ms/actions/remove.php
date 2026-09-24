<?php

return [
    'label' => 'Alih keluar',
    'modal' => [
        'heading' => 'Alih keluar kunci laluan ":name"',
        'description' => 'Anda tidak akan dapat log masuk lagi menggunakan kunci laluan ini. Kunci laluan lain anda akan terus berfungsi.',
        'description_last' => 'Ini adalah kunci laluan terakhir anda. Mengalih keluarnya akan mematikan pengesahan kunci laluan, yang mengurangkan satu lapisan keselamatan tambahan daripada akaun anda.',
        'actions' => [
            'submit' => [
                'label' => 'Alih keluar kunci laluan',
            ],
        ],
    ],
    'notifications' => [
        'removed' => [
            'title' => 'Kunci laluan dialih keluar',
        ],
    ],
];
