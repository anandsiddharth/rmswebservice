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

    public function index ($request, $response, $args) {
        $arg = $args;
//        $other = $args;
//        $result = $this->GEOcoder->geocoder->geocodeQuery(GeocodeQuery::create('Buckingham Palace, London'));
//        $result = $this->GEOcoder->geocoder->reverseQuery(ReverseQuery::fromCoordinates(24,55));
//        $arg = array_merge($result, $other);
        return $this->view->render($response, 'home.twig', compact('arg'));
    }

    public function postMap ($request, $response, $args) {

        // Validation
        // Submitting Data
        // Responding


        echo $ref = $request->getParam('ref');
        echo "<br/>";
        echo $token = $request->getParam('token');
        echo "<br/>";
        echo $long = $request->getParam('long');
        echo "<br/>";
        echo $lat = $request->getParam('lat');


        echo "Shiblie is right";
        die();
        // respond with JSON
        return $this->view->render($response, 'response.twig', compact('arg'));

    }

}