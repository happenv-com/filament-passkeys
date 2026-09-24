<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => '패스키 인증',
            'below_content' => '로그인 시 신원 확인을 위해 패스키(Face ID, Touch ID, Windows Hello, Android, 보안 키)를 사용합니다. 로그인하는 모든 기기마다 하나씩 추가하세요.',
            'messages' => [
                'enabled' => '활성화됨',
                'disabled' => '비활성화됨',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => '패스키',
                'last_used_at' => '마지막 사용',
                'actions' => '작업',
            ],
            'never_used' => '없음',
        ],
    ],
    'login_form' => [
        'label' => '패스키 사용',
        'credential' => [
            'label' => '패스키',
            'messages' => [
                'invalid' => '패스키를 확인할 수 없습니다. 다시 시도하세요.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => '패스키로 인증',
            ],
        ],
    ],
];
