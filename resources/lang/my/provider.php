<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'passkey ဖြင့် အတည်ပြုခြင်း',
            'below_content' => 'အကောင့်ဝင်စဉ် မည်သူမည်ဝါဖြစ်ကြောင်း အတည်ပြုရန် passkey (Face ID, Touch ID, Windows Hello, Android, လုံခြုံရေးကီး) ကို အသုံးပြုပါ။ သင်အကောင့်ဝင်သည့် စက်ပစ္စည်းတိုင်းအတွက် တစ်ခုစီ ထည့်ပါ။',
            'messages' => [
                'enabled' => 'ဖွင့်ထားသည်',
                'disabled' => 'ပိတ်ထားသည်',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Passkey',
                'last_used_at' => 'နောက်ဆုံးအသုံးပြုချိန်',
                'actions' => 'လုပ်ဆောင်ချက်များ',
            ],
            'never_used' => 'တစ်ခါမျှ',
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
