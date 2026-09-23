<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'পাসকী যাচাইকরণ',
            'below_content' => 'লগইনের সময় আপনার পরিচয় যাচাই করতে এই ডিভাইসে একটি পাসকী (Face ID, Touch ID, Windows Hello, সিকিউরিটি কী) ব্যবহার করুন।',
            'messages' => [
                'enabled' => 'সক্রিয়',
                'disabled' => 'নিষ্ক্রিয়',
            ],
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
