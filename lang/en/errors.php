<?php

return [
    'home' => 'Back to home',
    'logout' => 'Logout',

    '400' => [
        'title' => 'Bad Request',
        'body' => 'Your request could not be processed.',
    ],

    '401' => [
        'title' => 'Unauthorized',
        'body' => 'Authentication is required to access this page.',
    ],

    '402' => [
        'title' => 'Payment Required',
        'body' => 'Payment is needed to access this resource.',
    ],

    '403' => [
        'title' => 'Forbidden',
        'body' => 'You are not allowed to access this page.',
    ],

    '404' => [
        'title' => 'Not Found',
        'body' => 'The requested resource could not be found.',
    ],

    '405' => [
        'title' => 'Method Not Allowed',
        'body' => 'This request method is not supported.',
    ],

    '408' => [
        'title' => 'Request Timeout',
        'body' => 'The server timed out waiting for your request.',
    ],

    '409' => [
        'title' => 'Conflict',
        'body' => 'Your request conflicts with the current state.',
    ],

    '410' => [
        'title' => 'Gone',
        'body' => 'This resource is no longer available.',
    ],

    '413' => [
        'title' => 'Payload Too Large',
        'body' => 'The request size is too large to process.',
    ],

    '414' => [
        'title' => 'URI Too Long',
        'body' => 'The URL is too long to handle.',
    ],

    '415' => [
        'title' => 'Unsupported Media Type',
        'body' => 'This media type is not supported.',
    ],

    '429' => [
        'title' => 'Too Many Requests',
        'body' => 'You sent too many requests. Please try later.',
    ],

    '419' => [
        'title' => 'Page Expired',
        'body' => 'Your session has expired.',
    ],

    '500' => [
        'title' => 'Server Error',
        'body' => 'An unexpected error occurred.',
    ],

    '501' => [
        'title' => 'Not Implemented',
        'body' => 'This feature is not supported.',
    ],

    '502' => [
        'title' => 'Bad Gateway',
        'body' => 'Invalid response from the upstream server.',
    ],

    '503' => [
        'title' => 'Under Maintenance',
        'body' => 'We are performing maintenance. Please try again soon.',
    ],

    '504' => [
        'title' => 'Gateway Timeout',
        'body' => 'The server did not respond in time.',
    ],

    '505' => [
        'title' => 'HTTP Version Not Supported',
        'body' => 'This HTTP version is not supported.',
    ],
];
