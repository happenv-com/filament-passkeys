<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Հաստատում մուտքի բանալիով',
            'below_content' => 'Օգտագործեք այս սարքի մուտքի բանալին (Face ID, Touch ID, Windows Hello, անվտանգության բանալի)՝ մուտքի ժամանակ ձեր անձը հաստատելու համար։',
            'messages' => [
                'enabled' => 'Միացված է',
                'disabled' => 'Անջատված է',
            ],
        ],
    ],
    'login_form' => [
        'label' => 'Օգտագործեք մուտքի բանալի',
        'credential' => [
            'label' => 'մուտքի բանալի',
            'messages' => [
                'invalid' => 'Չհաջողվեց հաստատել մուտքի բանալին։ Խնդրում ենք կրկին փորձել։',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Հաստատել մուտքի բանալիով',
            ],
        ],
    ],
];
