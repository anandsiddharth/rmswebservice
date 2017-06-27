<?php
/**
 * Created by PhpStorm.
 * User: shiblie
 * Date: 6/22/17
 * Time: 12:56 PM
 */

use App\Controllers\HomeController;



$app->get('/[{ref}[/{token}]]', HomeController::class . ':index')->setName('home');
$app->post('/', HomeController::class . ':postMap');