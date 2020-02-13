<?php

return [
    'plural' => 'Admins',
    'singular' => 'Admin',
    'empty' => 'There are no admins',
    'actions' => [
        'list' => 'List Admins',
        'show' => 'Show Admin',
        'create' => 'Create a new admin',
        'edit' => 'Edit Admin',
        'delete' => 'Delete Admin',
        'save' => 'Save',
    ],
    'messages' => [
        'created' => 'The admin has been created successfully.',
        'updated' => 'The admin has been updated successfully.',
        'deleted' => 'The admin has been deleted successfully.',
    ],
    'attributes' => [
        'name' => 'Name',
        'email' =>  'Email',
        'password' => 'Password',
        'password_confirmation' => 'Password Confirmation',
        'type' => 'Type',
        'avatar' => 'Avatar',
    ],
    'types' => [
        \App\Models\User::USER_TYPE => 'User',
        \App\Models\User::ADMIN_TYPE => 'Admin',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to delete the admin ?',
            'confirm' => 'Delete',
            'cancel' => 'Cancel',
        ],
    ],
];
