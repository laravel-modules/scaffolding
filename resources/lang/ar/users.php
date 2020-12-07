<?php

return [
    'plural' => 'العضويات',
    'since' => 'عضو :date',
    'profile' => 'الملف الشخصي',
    'types' => [
        \App\Models\User::ADMIN_TYPE => 'مسئول',
        \App\Models\User::CUSTOMER_TYPE => 'عميل',
    ],
];
