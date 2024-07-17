<?php

return [
    'active' => env('IDENTIFY_ACTIVE', false),

    'prefix' => 'identify_',

    'redirect-route' => env('IDENTIFY_REDIRECT_ROUTE', 'dashboard'),

    'time_to_persist_cookie_identification' => 43800,
];
