<?php

return [
    'actions' => [
        'delete' => 'Delete Selected',
        'restore' => 'Restore Selected',
    ],
    'messages' => [
        'deleted' => 'The :type has been selected successfully.',
        'restored' => 'The :type has been restored successfully.',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to delete the :type ?',
            'confirm' => 'Delete',
            'cancel' => 'Cancel',
        ],
        'restore' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to restore the :type ?',
            'confirm' => 'Restore',
            'cancel' => 'Cancel',
        ],
        'forceDelete' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to delete the :type forever?',
            'confirm' => 'Force Delete',
            'cancel' => 'Cancel',
        ],
    ],
];
