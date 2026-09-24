<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'পাসকী যাচাইকরণ',
            'below_content' => 'লগইনের সময় আপনার পরিচয় যাচাই করতে একটি পাসকী (Face ID, Touch ID, Windows Hello, Android, সিকিউরিটি কী) ব্যবহার করুন। আপনি যে প্রতিটি ডিভাইস থেকে সাইন ইন করেন, তার জন্য একটি করে যোগ করুন।',
            'messages' => [
                'enabled' => 'সক্রিয়',
                'disabled' => 'নিষ্ক্রিয়',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'পাসকী',
                'last_used_at' => 'সর্বশেষ ব্যবহৃত',
                'actions' => 'কার্যক্রম',
            ],
            'never_used' => 'কখনও না',
        ],
    ],
    'login_form' => [
        'label' => 'একটি পাসকী ব্যবহার করুন',
        'credential' => [
            'label' => 'পাসকী',
            'messages' => [
                'invalid' => 'পাসকীটি যাচাই করা যায়নি। অনুগ্রহ করে আবার চেষ্টা করুন।',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'পাসকী দিয়ে যাচাই করুন',
            ],
        ],
    ],
];
