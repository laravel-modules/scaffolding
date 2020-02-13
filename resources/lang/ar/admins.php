<?php

return [
    'plural' => 'المسئولين',
    'singular' => 'المسئول',
    'empty' => 'لا توجد مسئولين',
    'actions' => [
        'list' => 'عرض المسئولين ',
        'show' => 'عرض',
        'create' => 'إضافة مسئول جديد',
        'edit' => 'تعديل  المسئول',
        'delete' => 'حذف المسئول',
        'save' => 'حفظ',
    ],
    'messages' => [
        'created' => 'تم إضافة المسئول بنجاح .',
        'updated' => 'تم تعديل المسئول بنجاح .',
        'deleted' => 'تم حذف المسئول بنجاح .',
    ],
    'attributes' => [
        'name' => 'اسم المسئول',
        'email' =>  'البريد الالكترونى',
        'password' => 'كلمة السر',
        'password_confirmation' => 'تأكيد كلمة السر',
        'type' => 'الصلاحية',
        'avatar' => 'الصورة الشخصية',
    ],
    'types' => [
        \App\Models\User::USER_TYPE => 'مستخدم عادي',
        \App\Models\User::ADMIN_TYPE => 'مسئول',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'تحذير !',
            'info' => 'هل أنت متأكد انك تريد حذف هذا المسئول ?',
            'confirm' => 'حذف',
            'cancel' => 'إلغاء',
        ],
    ],
];
