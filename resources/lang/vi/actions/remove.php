<?php

return [
    'label' => 'Xóa',
    'modal' => [
        'heading' => 'Xóa khóa truy cập ":name"',
        'description' => 'Bạn sẽ không thể đăng nhập bằng khóa truy cập này nữa. Các khóa truy cập khác của bạn vẫn hoạt động bình thường.',
        'description_last' => 'Đây là khóa truy cập cuối cùng của bạn. Xóa khóa này sẽ tắt tính năng xác thực bằng khóa truy cập, làm mất đi một lớp bảo mật bổ sung cho tài khoản của bạn.',
        'actions' => [
            'submit' => [
                'label' => 'Xóa khóa truy cập',
            ],
        ],
    ],
    'notifications' => [
        'removed' => [
            'title' => 'Đã xóa khóa truy cập',
        ],
    ],
];
