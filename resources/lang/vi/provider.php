<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Xác thực bằng khóa truy cập',
            'below_content' => 'Sử dụng khóa truy cập trên thiết bị này (Face ID, Touch ID, Windows Hello, khóa bảo mật) để xác minh danh tính của bạn khi đăng nhập.',
            'messages' => [
                'enabled' => 'Đã bật',
                'disabled' => 'Đã tắt',
            ],
        ],
    ],
    'login_form' => [
        'label' => 'Sử dụng khóa truy cập',
        'credential' => [
            'label' => 'khóa truy cập',
            'messages' => [
                'invalid' => 'Không thể xác minh khóa truy cập. Vui lòng thử lại.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Xác minh bằng khóa truy cập',
            ],
        ],
    ],
];
