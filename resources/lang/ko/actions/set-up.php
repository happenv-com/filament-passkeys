<?php

return [
    'label' => '설정',
    'add_label' => '패스키 추가',
    'modal' => [
        'heading' => '패스키 인증 설정',
        'add_heading' => '패스키 추가',
        'description' => '이 기기에 패스키를 등록합니다. 지문, 얼굴 인식, 화면 잠금 또는 보안 키를 사용하라는 메시지가 표시됩니다. 등록이 완료되면 이 패스키로 로그인할 수 있습니다.',
        'form' => [
            'name' => [
                'label' => '패스키 이름',
                'placeholder' => '예: MacBook Touch ID, YubiKey 5C',
                'helper_text' => '선택 사항입니다. 비워두면 기기 또는 비밀번호 관리자 이름으로 지정됩니다.',
                'default' => '패스키',
            ],
            'submit' => [
                'label' => '패스키 등록',
            ],
            'errors' => [
                'failed' => '패스키를 등록할 수 없습니다. 다시 시도하세요.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => '패스키가 등록되었습니다',
        ],
        'already_registered' => [
            'title' => '이 기기에는 이미 패스키가 있습니다',
            'body' => '이 계정의 패스키가 이미 이 기기 또는 비밀번호 관리자에 저장되어 있습니다. 대신 다른 기기에서 추가하세요.',
        ],
    ],
];
