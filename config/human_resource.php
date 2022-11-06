<?php
/**
 * Only super users have access to the admin panel. Provide a string of super user
 * emails separate by comma (,) or pipe(|).
 */
return [
    'super_users' => env('HUMAN_RESOURCE_SUPER_USERS', 'yismen.jorge@gmail.com'),
    /**
    * Here you can specify a list of middleware to apply to
    * all routes. use "," or "|" to separate the list.
    */
    'midlewares' => [
        'api' => 'api',
        'web' => 'auth',
    ],
    'db_prefix' => '',
    'routes_prefix' => [
        'guest' => '',
        'admin' => 'admin'
    ],
    'layout' => env('LAYOUT_VIEW', 'human_resource::layouts.app')
];
