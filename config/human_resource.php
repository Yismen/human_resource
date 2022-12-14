<?php
/**
 * Only super users have access to the admin panel. Provide a string of super user
 * emails separate by comma (,) or pipe(|).
 */
return [
    'super_users' => env('HUMAN_RESOURCE_SUPER_USERS', null),
    /**
    * Here you can specify a list of middleware to apply to
    * all routes. use "," or "|" to separate the list.
    */
    'midlewares' => [
        'api' => 'api',
        'web' => 'auth',
    ],
    'db_prefix' => 'hr_',
    'routes_prefix' => [
        'guest' => 'hr',
        'admin' => 'hr/admin'
    ],
    'seeds' => [
        'termination_types' => [],
        'termination_reasons' => [],
        'suspension_types' => [],
        'citizenships' => [],
        'departments' => [],
        'payment_types' => [],
    ],
    'layout' => env('LAYOUT_VIEW', 'human_resource::layouts.app')
];
