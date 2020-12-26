<?php

return [
    'plural' => 'العضويات',
    'since' => 'عضو :date',
    'profile' => 'الملف الشخصي',
    'verified' => 'مفعل',
    'unverified' => 'غير مفعل',
    'types' => [
        \App\Models\User::ADMIN_TYPE => 'مسئول',
        \App\Models\User::CUSTOMER_TYPE => 'عميل',
    ],
];
