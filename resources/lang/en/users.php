<?php

return [
    'plural' => 'Accounts',
    'since' => 'Member since :date',
    'profile' => 'Profile',
    'verified' => 'Verified',
    'unverified' => 'Unverified',
    'types' => [
        \App\Models\User::ADMIN_TYPE => 'Admin',
        \App\Models\User::SUPERVISOR_TYPE => 'Supervisor',
        \App\Models\User::CUSTOMER_TYPE => 'Customer',
    ],
    'impersonate' => [
        'go' => 'Go To Dashboard',
        'leave' => 'Back To Previous Account',
    ],
];
