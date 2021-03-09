<?php

return [
    'plural' => 'Admins',
    'singular' => 'Admin',
    'empty' => 'There are no admins',
    'select' => 'Select Admin',
    'trashed' => 'Trashed Admins',
    'perPage' => 'Count Results Per Page',
    'actions' => [
        'list' => 'List Admins',
        'show' => 'Show Admin',
        'create' => 'Create',
        'new' => 'New',
        'edit' => 'Edit Admin',
        'delete' => 'Delete Admin',
        'save' => 'Save',
        'filter' => 'Filter',
    ],
    'messages' => [
        'created' => 'The admin has been created successfully.',
        'updated' => 'The admin has been updated successfully.',
        'deleted' => 'The admin has been deleted successfully.',
        'restored' => 'The admin has been restored successfully.',
    ],
    'attributes' => [
        'name' => 'Name',
        'phone' => 'Phone',
        'email' => 'Email',
        'created_at' => 'The Date Of Join',
        'old_password' => 'Old Password',
        'password' => 'Password',
        'password_confirmation' => 'Password Confirmation',
        'type' => 'User Type',
        'avatar' => 'Avatar',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to delete the admin ?',
            'confirm' => 'Delete',
            'cancel' => 'Cancel',
        ],
        'restore' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to restore the admin ?',
            'confirm' => 'Restore',
            'cancel' => 'Cancel',
        ],
        'forceDelete' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to force delete the admin ?',
            'confirm' => 'Force',
            'cancel' => 'Cancel',
        ],
    ],
];
