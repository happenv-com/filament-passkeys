<?php

return [
    'label' => 'រៀបចំ',
    'add_label' => 'បន្ថែម passkey',
    'modal' => [
        'heading' => 'រៀបចំការផ្ទៀងផ្ទាត់ដោយ passkey',
        'add_heading' => 'បន្ថែម passkey មួយ',
        'description' => 'ចុះឈ្មោះ passkey នៅលើឧបករណ៍នេះ។ អ្នកនឹងត្រូវបានស្នើឱ្យប្រើស្នាមម្រាមដៃ មុខ ការចាក់សោអេក្រង់ ឬកូនសោសុវត្ថិភាព។ បន្ទាប់ពីចុះឈ្មោះ អ្នកនឹងអាចចូលដោយប្រើ passkey នេះ។',
        'form' => [
            'name' => [
                'label' => 'ឈ្មោះ passkey',
                'placeholder' => 'ឧ. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'ស្រេចចិត្ត។ ទុកវាឱ្យទទេ ដើម្បីដាក់ឈ្មោះវាតាមឧបករណ៍ ឬកម្មវិធីគ្រប់គ្រងពាក្យសម្ងាត់របស់អ្នក។',
                'default' => 'Passkey',
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
        'already_registered' => [
            'title' => 'ឧបករណ៍នេះមាន passkey រួចហើយ',
            'body' => 'passkey សម្រាប់គណនីរបស់អ្នក ត្រូវបានរក្សាទុករួចហើយនៅលើឧបករណ៍ ឬកម្មវិធីគ្រប់គ្រងពាក្យសម្ងាត់នេះ។ សូមបន្ថែម passkey ពីឧបករណ៍ផ្សេងទៀតជំនួសវិញ។',
        ],
    ],
];
