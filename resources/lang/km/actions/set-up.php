<?php

return [
    'label' => 'រៀបចំ',
    'modal' => [
        'heading' => 'រៀបចំការផ្ទៀងផ្ទាត់ដោយ passkey',
        'description' => 'ចុះឈ្មោះ passkey នៅលើឧបករណ៍នេះ។ អ្នកនឹងត្រូវបានស្នើឱ្យប្រើស្នាមម្រាមដៃ មុខ ការចាក់សោអេក្រង់ ឬកូនសោសុវត្ថិភាព។ បន្ទាប់ពីចុះឈ្មោះ អ្នកនឹងអាចចូលដោយប្រើ passkey នេះ។',
        'form' => [
            'name' => [
                'label' => 'ឈ្មោះ passkey',
                'placeholder' => 'ឧ. MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'ចុះឈ្មោះ passkey',
            ],
            'errors' => [
                'failed' => 'យើងមិនអាចចុះឈ្មោះ passkey របស់អ្នកបានទេ។ សូមព្យាយាមម្តងទៀត។',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'passkey ត្រូវបានចុះឈ្មោះដោយជោគជ័យ',
        ],
    ],
];
