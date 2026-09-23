<?php

return [
    'label' => 'Cài đặt',
    'modal' => [
        'heading' => 'Cài đặt xác thực bằng khóa truy cập',
        'description' => 'Đăng ký khóa truy cập trên thiết bị này. Bạn sẽ được yêu cầu sử dụng vân tay, khuôn mặt, khóa màn hình hoặc khóa bảo mật. Sau khi đăng ký, bạn có thể đăng nhập bằng khóa truy cập này.',
        'form' => [
            'name' => [
                'label' => 'Tên khóa truy cập',
                'placeholder' => 'ví dụ: MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Đăng ký khóa truy cập',
            ],
            'errors' => [
                'failed' => 'Chúng tôi không thể đăng ký khóa truy cập của bạn. Vui lòng thử lại.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Đã đăng ký khóa truy cập thành công',
        ],
    ],
];
