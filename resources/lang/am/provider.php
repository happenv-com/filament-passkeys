<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'የይለፍ ቁልፍ ማረጋገጫ',
            'below_content' => 'በሚገቡበት ጊዜ ማንነትዎን ለማረጋገጥ በዚህ መሣሪያ ላይ የይለፍ ቁልፍ (Face ID, Touch ID, Windows Hello, የደህንነት ቁልፍ) ይጠቀሙ።',
            'messages' => [
                'enabled' => 'ነቅቷል',
                'disabled' => 'ተሰናክሏል',
            ],
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
