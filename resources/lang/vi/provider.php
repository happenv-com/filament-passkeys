<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Xác thực bằng khóa truy cập',
            'below_content' => 'Sử dụng khóa truy cập (Face ID, Touch ID, Windows Hello, Android, khóa bảo mật) để xác minh danh tính của bạn khi đăng nhập. Hãy thêm một khóa cho mỗi thiết bị bạn dùng để đăng nhập.',
            'messages' => [
                'enabled' => 'Đã bật',
                'disabled' => 'Đã tắt',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Khóa truy cập',
                'last_used_at' => 'Lần sử dụng gần nhất',
                'actions' => 'Hành động',
            ],
            'never_used' => 'Chưa từng',
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
