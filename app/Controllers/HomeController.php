<?php
/**
 * Created by PhpStorm.
 * User: shiblie
 * Date: 6/22/17
 * Time: 12:42 PM
 */

namespace App\Controllers;

use App\Controllers\Controller;
use Geocoder\Query\GeocodeQuery;
use Geocoder\Query\ReverseQuery;
use JeroenDesloovere\Geolocation\Geolocation;


class HomeController extends Controller {

    public function index ($request, $response, $case) {
        if( empty($request->getAttribute("case")) || empty($request->getAttribute("token"))){
            return $this->view->render($response, 'home/error.twig');
        }
        $case = $request->getAttribute('case');
        $token = $request->getAttribute('token');
        return $this->view->render($response, 'home/index.twig', compact('case', 'token'));
    }

    public function postMap ($request, $response, $args) {
        echo "s";
        var_dump($_POST);
        return $request->getParsedBody();

    }

}