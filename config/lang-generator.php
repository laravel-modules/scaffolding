<?php

return [
    'defaultLang' => 'ar',

    /*
     * The lang files paths.
     */

    'lang' => [
        'auth' => base_path('lang/{lang}/auth.php'),
        'pagination' => base_path('lang/{lang}/pagination.php'),
        'passwords' => base_path('lang/{lang}/passwords.php'),
        'validation' => base_path('lang/{lang}/validation.php'),
        'admins' => base_path('lang/{lang}/admins.php'),
        'backup' => base_path('lang/{lang}/backup.php'),
        'check-all' => base_path('lang/{lang}/check-all.php'),
        'customers' => base_path('lang/{lang}/customers.php'),
        'dashboard' => base_path('lang/{lang}/dashboard.php'),
        'feedback' => base_path('lang/{lang}/feedback.php'),
        'permissions' => base_path('lang/{lang}/permissions.php'),
        'select2' => base_path('lang/{lang}/select2.php'),
        'settings' => base_path('lang/{lang}/settings.php'),
        'supervisors' => base_path('lang/{lang}/supervisors.php'),
        'users' => base_path('lang/{lang}/users.php'),
        'verification' => base_path('lang/{lang}/verification.php'),
        /*  The lang of generated crud will set here: Don't remove this line */
    ],

    /*
     * The paths that will scan for translations.
     */

    'matches' => [
        app_path(),
        resource_path('views'),
    ],
];
