# Identify Email 2FA
Identity is a package that authorises the device used by a user, which places a 32 character cookie token on their device, 
which we use to validate against.

### Publish the config
You can publish the config, using:
```bash
php artisan vendor:publish --tag=identify-config
```

This will render the following config.

```php
<?php

return [
    'active' => env('IDENTIFY_ACTIVE', false),

    'prefix' => 'identify_',

    'redirect-route' => env('IDENTIFY_REDIRECT_ROUTE', 'dashboard'),

    'time_to_persist_cookie_identification' => 43800,
];
```

### Migrations
Identify stores all the tokens against the authenticated user, and uses this data to verify a valid token has been validated by email.

```bash
php artisan migrate
```
