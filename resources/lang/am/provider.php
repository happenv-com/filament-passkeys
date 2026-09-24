<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'የይለፍ ቁልፍ ማረጋገጫ',
            'below_content' => 'በሚገቡበት ጊዜ ማንነትዎን ለማረጋገጥ የይለፍ ቁልፍ (Face ID, Touch ID, Windows Hello, Android, የደህንነት ቁልፍ) ይጠቀሙ። ከሚገቡበት እያንዳንዱ መሣሪያ አንዱን ይጨምሩ።',
            'messages' => [
                'enabled' => 'ነቅቷል',
                'disabled' => 'ተሰናክሏል',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'የይለፍ ቁልፍ',
                'last_used_at' => 'የመጨረሻ አጠቃቀም',
                'actions' => 'ተግባሮች',
            ],
            'never_used' => 'በጭራሽ',
        ],
    ],
    'login_form' => [
        'label' => 'የይለፍ ቁልፍ ይጠቀሙ',
        'credential' => [
            'label' => 'የይለፍ ቁልፍ',
            'messages' => [
                'invalid' => 'የይለፍ ቁልፉን ማረጋገጥ አልተቻለም። እባክዎ እንደገና ይሞክሩ።',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'የይለፍ ቁልፍ በመጠቀም ያረጋግጡ',
            ],
        ],
    ],
];
