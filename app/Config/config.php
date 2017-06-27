<?php
/**
 * Created by PhpStorm.
 * User: shiblie
 * Date: 6/22/17
 * Time: 12:52 PM
 */

return [
    'settings'  =>  [       // Slim App Configurations
        'httpVersion'                       => '1.1',
        'responseChunkSize'                 => 4096,
        'outputBuffering'                   => 'append',
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails'               => true,    // change to false on production
        'addContentLengthHeader'            => true,
        'routerCacheFile'                   => false
    ],
    'db'        =>  [       // DB Configurations
        'driver'                            =>  'mysql',
        'host'                              =>  'localhost',
        'database'                          =>  'rmswebservice',
        'username'                          =>  'bshara',
        'password'                          =>  'P@ssw0rd',
        'charset'                           =>  'utf8',
        'collation'                         =>  'utf8_unicode_ci',
        'prefix'                            =>  ''
    ],
    'app'       =>  [
        'siteName'                          =>  'RMSWebService',
        'siteUrl'                           =>  '/',
        'hash'                              =>  [
            'algo'                  =>  PASSWORD_DEFAULT,
            'cost'                  =>  10
        ]
    ],
    'view'      =>  [
        'template'                          => __DIR__ . '/../../resources/views/',
        'cache'                             =>  false,
        'debug'                             =>  true,
        'auto_reload'                       =>  true,
        'cacheavail'                        =>  'public',
        'cachetime'                         =>  86400,             // seconds (1 day = 86400)
    ]
];