<?php

return [
    'defaultLang' => 'ar',

    /*
     * The lang files paths.
     */

    'lang' => [
        'auth' => resource_path('lang/{lang}/auth.php'),
        'pagination' => resource_path('lang/{lang}/pagination.php'),
        'passwords' => resource_path('lang/{lang}/passwords.php'),
        'validation' => resource_path('lang/{lang}/validation.php'),
        'admins' => resource_path('lang/{lang}/admins.php'),
        'backup' => resource_path('lang/{lang}/backup.php'),
        'check-all' => resource_path('lang/{lang}/check-all.php'),
        'customers' => resource_path('lang/{lang}/customers.php'),
        'dashboard' => resource_path('lang/{lang}/dashboard.php'),
        'feedback' => resource_path('lang/{lang}/feedback.php'),
        'permissions' => resource_path('lang/{lang}/permissions.php'),
        'select2' => resource_path('lang/{lang}/select2.php'),
        'settings' => resource_path('lang/{lang}/settings.php'),
        'supervisors' => resource_path('lang/{lang}/supervisors.php'),
        'users' => resource_path('lang/{lang}/users.php'),
        'verification' => resource_path('lang/{lang}/verification.php'),
        /*  The lang of generated crud will set here: Don't remove this line  */
    ],

    /*
     * The paths that will scanned for translations.
     */

    'matches' => [
        app_path(),
        resource_path('views'),
    ],
];