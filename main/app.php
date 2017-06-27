<?php
/**
 * Created by PhpStorm.
 * User: shiblie
 * Date: 6/22/17
 * Time: 12:37 PM
 */

use function Clue\StreamFilter\fun;
use Slim\App as Slim;
use Noodlehaus\Config;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Controllers\HomeController;

session_cache_limiter(false);
session_start();

// defining DIRECTORY SEPARATOR
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
//define Application root path
defined('ROOTPATH') ? null : define('ROOTPATH', dirname(__DIR__));
// define views path
defined('VIEWSPATH') ? null : define('VIEWSPATH', ROOTPATH . DS . 'resources' . DS . 'views' . DS);

// Autoload the composer libraries
require ROOTPATH . DS . 'vendor' . DS . 'autoload.php';

// pull in the configurations file
// TODO move configurations to DB
$settings = require (ROOTPATH . DS . 'app' . DS . 'Config' . DS . 'config.php');

$app = new Slim($settings);

$container = $app->getContainer();

$container['config'] = function ($container) {
    return new Config(
        ROOTPATH . DS . 'app' . DS . 'Config' . DS . 'config.php'
    );
};

$container['view'] = function ($container) {            // Add the Twig View dependency
    $view = new Twig(
        $container
            ->config
            ->get('view.template'), [
        'cache' =>  $container->config->get('view.cache'),
        'debug' =>  $container->config->get('view.debug')
    ]);
    $view
        ->addExtension (
            new TwigExtension (
                $container->router,
                $container->request->getUri()
            )
        );
    $view
        ->getEnvironment()
        ->addGlobal(
            'URI', [
                'FullPath'      =>  $container->request->getUri(),
                'Path'          =>  $container->request->getUri()->getPath(),
                'BasePath'      =>  $container->request->getUri()->getBasePath(),
                'query'         =>  $container->request->getParams()
            ]
        );

    return $view;
};

// DB Connection (using Illuminate DB Manager)
$capsule = new Capsule;
$capsule->addConnection($container->config->get('db'));
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule) {
    return $capsule;
};

// Add the Controllers:
$container['HomeController'] = function ($container) {
    return new HomeController();
};

$container['GEOcoder'] = function ($container) {
    $adapter  = new \Http\Adapter\Guzzle6\Client();
    $provider = new \Geocoder\Provider\GoogleMaps\GoogleMaps($adapter);
//    $geocoder = new \Geocoder\StatefulGeocoder($provider, 'en');
    $geocoder = new \Geocoder\StatefulGeocoder($provider, 'en');
};
require ROOTPATH . DS . 'app' . DS . 'Routes' . DS . 'web.php';