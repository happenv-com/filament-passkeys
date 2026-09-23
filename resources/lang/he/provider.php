<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'אימות באמצעות מפתח גישה',
            'below_content' => 'השתמש במפתח גישה במכשיר זה (Face ID, Touch ID, Windows Hello, מפתח אבטחה) כדי לאמת את זהותך בעת ההתחברות.',
            'messages' => [
                'enabled' => 'מופעל',
                'disabled' => 'מושבת',
            ],
        ],
    ],
    'login_form' => [
        'label' => 'שימוש במפתח גישה',
        'credential' => [
            'label' => 'מפתח גישה',
            'messages' => [
                'invalid' => 'לא ניתן היה לאמת את מפתח הגישה. נסה שוב.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'אימות באמצעות מפתח גישה',
            ],
        ],
    ],
];
