<?php

return [
    'plural' => 'Users',
    'singular' => 'User',
    'empty' => 'There are no users',
    'select' => 'Select User',
    'select-type' => 'All',
    'perPage' => 'Count Users Per Page',
    'actions' => [
        'list' => 'List Users',
        'show' => 'Show User',
        'create' => 'Create a new user',
        'edit' => 'Edit User',
        'delete' => 'Delete User',
        'save' => 'Save',
        'filter' => 'Filter',
    ],
    'messages' => [
        'created' => 'The user has been created successfully.',
        'updated' => 'The user has been updated successfully.',
        'deleted' => 'The user has been deleted successfully.',
    ],
    'attributes' => [
        'name' => 'Name',
        'email' =>  'Email',
        'password' => 'Password',
        'password_confirmation' => 'Password Confirmation',
        'type' => 'User Type',
        'avatar' => 'Avatar',
    ],
    'types' => [
        \App\Models\User::SUPERVISOR_TYPE => 'Supervisor',
        \App\Models\User::ADMIN_TYPE => 'Admin',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to delete the user ?',
            'confirm' => 'Delete',
            'cancel' => 'Cancel',
        ],
    ],
];
