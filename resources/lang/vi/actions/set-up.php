<?php

return [
    'label' => 'Cài đặt',
    'add_label' => 'Thêm khóa truy cập',
    'modal' => [
        'heading' => 'Cài đặt xác thực bằng khóa truy cập',
        'add_heading' => 'Thêm một khóa truy cập',
        'description' => 'Đăng ký khóa truy cập trên thiết bị này. Bạn sẽ được yêu cầu sử dụng vân tay, khuôn mặt, khóa màn hình hoặc khóa bảo mật. Sau khi đăng ký, bạn có thể đăng nhập bằng khóa truy cập này.',
        'form' => [
            'name' => [
                'label' => 'Tên khóa truy cập',
                'placeholder' => 'ví dụ: MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Không bắt buộc. Để trống để đặt tên theo thiết bị hoặc trình quản lý mật khẩu của bạn.',
                'default' => 'Khóa truy cập',
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
        'already_registered' => [
            'title' => 'Thiết bị này đã có khóa truy cập',
            'body' => 'Một khóa truy cập cho tài khoản của bạn đã được lưu trên thiết bị này hoặc trình quản lý mật khẩu. Hãy thêm một khóa từ thiết bị khác.',
        ],
    ],
];
