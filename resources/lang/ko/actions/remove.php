<?php

return [
    'label' => '제거',
    'modal' => [
        'heading' => '패스키 ":name" 제거',
        'description' => '이제 이 패스키로 로그인할 수 없습니다. 다른 패스키는 계속 사용할 수 있습니다.',
        'description_last' => '이는 마지막 남은 패스키입니다. 제거하면 패스키 인증이 꺼지며, 계정의 추가 보안 계층이 사라집니다.',
        'actions' => [
            'submit' => [
                'label' => '패스키 제거',
            ],
        ],
    ],
    'notifications' => [
        'removed' => [
            'title' => '패스키가 제거되었습니다',
        ],
    ],
];
