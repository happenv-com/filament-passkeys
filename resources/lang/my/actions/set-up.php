<?php

return [
    'label' => 'စီစဉ်သတ်မှတ်ရန်',
    'modal' => [
        'heading' => 'passkey ဖြင့် အတည်ပြုခြင်းကို စီစဉ်သတ်မှတ်ရန်',
        'description' => 'ဤစက်ပစ္စည်းတွင် passkey တစ်ခုကို မှတ်ပုံတင်ပါ။ သင့်လက်ဗွေ၊ မျက်နှာ၊ မျက်နှာပြင်လော့ခ် သို့မဟုတ် လုံခြုံရေးကီးကို အသုံးပြုရန် တောင်းဆိုပါမည်။ မှတ်ပုံတင်ပြီးနောက် ဤ passkey ဖြင့် အကောင့်ဝင်နိုင်ပါမည်။',
        'form' => [
            'name' => [
                'label' => 'passkey အမည်',
                'placeholder' => 'ဥပမာ MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'passkey ကို မှတ်ပုံတင်ရန်',
            ],
            'errors' => [
                'failed' => 'သင့် passkey ကို မှတ်ပုံတင်၍ မရပါ။ ထပ်စမ်းကြည့်ပါ။',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'passkey ကို မှတ်ပုံတင်ပြီးပါပြီ',
        ],
    ],
];
