<?php

return [
    'plural' => 'المستخدمين',
    'singular' => 'المستخدم',
    'empty' => 'لا توجد مستخدمين',
    'select' => 'اختر المستخدم',
    'select-type' => 'الكل',
    'perPage' => 'عدد المستخدمين في الصفحة',
    'actions' => [
        'list' => 'عرض المستخدمين ',
        'show' => 'عرض',
        'create' => 'إضافة مستخدم جديد',
        'edit' => 'تعديل  المستخدم',
        'delete' => 'حذف المستخدم',
        'save' => 'حفظ',
        'filter' => 'بحث',
    ],
    'messages' => [
        'created' => 'تم إضافة المستخدم بنجاح .',
        'updated' => 'تم تعديل المستخدم بنجاح .',
        'deleted' => 'تم حذف المستخدم بنجاح .',
    ],
    'attributes' => [
        'name' => 'اسم المستخدم',
        'email' =>  'البريد الالكترونى',
        'password' => 'كلمة السر',
        'password_confirmation' => 'تأكيد كلمة السر',
        'type' => 'نوع المستخدم',
        'avatar' => 'الصورة الشخصية',
    ],
    'types' => [
        \Modules\Accounts\Entities\User::SUPERVISOR_TYPE => 'مشرف',
        \Modules\Accounts\Entities\User::ADMIN_TYPE => 'مسئول',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'تحذير !',
            'info' => 'هل أنت متأكد انك تريد حذف هذا المستخدم ?',
            'confirm' => 'حذف',
            'cancel' => 'إلغاء',
        ],
    ],
];
