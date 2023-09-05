<?php

return [
    'GOOGLE_CLIENT_ID' => env('GOOGLE_CLIENT_ID', null),
    'GOOGLE_CLIENT_SECRET' => env('GOOGLE_CLIENT_SECRET', null),
    'GOOGLE_REDIRECT_URL' => env('GOOGLE_REDIRECT_URL', null),
    'GOOGLE_SCOPES' => [
        'https://www.googleapis.com/auth/userinfo.email',
        'https://www.googleapis.com/auth/userinfo.profile',
        'https://www.googleapis.com/auth/calendar',
        'https://www.googleapis.com/auth/calendar.events',
        'https://www.googleapis.com/auth/calendar.events.readonly',
        'https://www.googleapis.com/auth/calendar.readonly',
    ],
    'GOOGLE_APPROVAL_PROMPT' => env('GOOGLE_APPROVAL_PROMPT', 'force'),
    'GOOGLE_ACCESS_TYPE' => env('GOOGLE_ACCESS_TYPE', 'offline'),
];