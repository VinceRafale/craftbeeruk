<?php

namespace Craft\LocationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Guzzle\Service\Client as Guzzle;

class DefaultController extends Controller {

    /**
     * @Route("/locate/{longitude}/{latitude}")
     * @Template()
     */
    public function indexAction($longitude, $latitude) {
        //http://overpass.osm.rambler.ru/cgi/interpreter?data=%5Bout:json%5D;node%5Bcraft_beer%3Dyes%5D%3Bout%3B
        $osm = new Guzzle('http://overpass-api.de/api');
        $response = $osm->get('xapi?*[craft_beer=yes]')->send();

        if ($response->getStatusCode() == 200) {
            $body = $response->getBody();
            $results = new \SimpleXMLElement($body);
            foreach ($results->xpath('*[tag[@k="name"]]') as $location) {
                $tags = [];
                foreach($location->tag as $tag) {
                    $tags[(string)$tag['k']] = (string)$tag['v'];
                }
                var_dump($tags);
            }

            $foo['name'] = 'Location';
            return $foo;
        }
    }

}
