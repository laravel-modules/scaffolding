<?php

return [
    'plural' => 'Accounts',
    'types' => [
        \Modules\Accounts\Entities\User::ADMIN_TYPE => 'Admin',
        \Modules\Accounts\Entities\User::CUSTOMER_TYPE => 'Customer',
    ],
];
