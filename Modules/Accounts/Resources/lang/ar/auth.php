<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'بيانات الاعتماد هذه غير متطابقة مع البيانات المسجلة لدينا.',
    'password' => 'كلمة المرور التي ادخلتها غير صحيحة!',
    'throttle' => 'عدد كبير جدا من محاولات الدخول. يرجى المحاولة مرة أخرى بعد :seconds ثانية.',
    'attributes' => [
        'code' => 'رمز التحقق',
        'token' => 'شفرة التحقق',
        'email' => 'البريد الالكتروني',
        'phone' => 'رقم الهاتف',
        'username' => 'البريد الالكترونى او رقم الهاتف',
        'password' => 'كلمة المرور',
    ],
    'messages' => [
        'forget-password-code-sent' => 'لفد تم ارسال رمز استعادة كلمة المرور على بريدك الالكتروني',
    ],
    'emails' => [
        'forget-password' => [
            'subject' => 'استعادة كلمة المرور',
            'greeting' => 'عزيزي :user',
            'line' => "رمز استعادة كلمة المرور الخاص بك هو :code صالح لمدة :minutes دقائق",
            'footer' => 'شكراً لاستخدامك لتطبيقنا',
            'salutation' => 'مع تحيات فريق عمل :app',
        ],
        'reset-password' => [
            'subject' => 'استعادة كلمة المرور',
            'greeting' => 'عزيزي :user',
            'line' => 'تم تغيير كلمة المرور الخاصة بك',
            'footer' => 'شكراً لاستخدامك لتطبيقنا',
            'salutation' => 'مع تحيات فريق عمل :app',
        ],
    ],

];
