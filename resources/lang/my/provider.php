<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'passkey ဖြင့် အတည်ပြုခြင်း',
            'below_content' => 'အကောင့်ဝင်စဉ် မည်သူမည်ဝါဖြစ်ကြောင်း အတည်ပြုရန် ဤစက်ပစ္စည်းရှိ passkey (Face ID, Touch ID, Windows Hello, လုံခြုံရေးကီး) ကို အသုံးပြုပါ။',
            'messages' => [
                'enabled' => 'ဖွင့်ထားသည်',
                'disabled' => 'ပိတ်ထားသည်',
            ],
        ],
    ],
    'login_form' => [
        'label' => 'passkey ကို အသုံးပြုရန်',
        'credential' => [
            'label' => 'passkey',
            'messages' => [
                'invalid' => 'passkey ကို အတည်ပြု၍ မရပါ။ ထပ်စမ်းကြည့်ပါ။',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'passkey ဖြင့် အတည်ပြုရန်',
            ],
        ],
    ],
];
