<?php

return [
    'jobs' => 'Email Jobs',
    'empty' => 'There are no email jobs',
    'management' => 'Emails Management',
    'settings' => 'Mail Settings',
    'smtp' => 'SMTP Settings',
    'actions' => [
        'send' => 'Send Batch Email',
        'confirm' => 'Send',
        'cancel' => 'Cancel',
    ],
    'statuses' => [
        'queued' => 'Queued',
        'sending' => 'Sending',
        'sent' => 'Sent',
        'failed' => 'Failed',
    ],
    'errors' => [
        'not_email' => 'The ":model" model does not have an email address.',
    ],
    'messages' => [
        'sending' => 'Emails are being sent.',
        'sent' => 'Email :email was sent to :user successfully.',
        'failed' => 'Email :email failed to send to :user.',
    ],
    'attributes' => [
        'emails_per_day' => 'Emails Per Day',
        'email' => 'Email',
        'send_at' => 'Send At',
        'subject' => 'Subject',
        'content' => 'Content',
        'status' => 'Status',
        'model' => 'Recipient',
    ],
];
