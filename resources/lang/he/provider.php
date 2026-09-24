<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'אימות באמצעות מפתח גישה',
            'below_content' => 'השתמש במפתח גישה (Face ID, Touch ID, Windows Hello, Android, מפתח אבטחה) כדי לאמת את זהותך בעת ההתחברות. הוסף אחד עבור כל מכשיר שממנו אתה מתחבר.',
            'messages' => [
                'enabled' => 'מופעל',
                'disabled' => 'מושבת',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'מפתח גישה',
                'last_used_at' => 'שימוש אחרון',
                'actions' => 'פעולות',
            ],
            'never_used' => 'מעולם לא',
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
