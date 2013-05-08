<?php

namespace Craft\LocationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Guzzle\Service\Client as Guzzle;
use Craft\LocationBundle\Document;
use Ricklab\Location;

class DefaultController extends Controller {

    /**
     * @Route("/around-me")
     * @Template()
     */
    public function indexAction() {
        
        return $this->render('CraftLocationBundle:Default:index.html.twig');
    }
    
    /**
     * @Route("/around/{latitude}/{longitude}/{limit}")
     */
    public function findAtLocation($latitude, $longitude, $limit) {
        
        $point  = new Location\Point((float)$latitude, (float)$longitude);
        
        $locations = $this->get('location_service')->getLocationsAround($point, $limit);
        
        foreach($locations as $location) {
            var_dump($location);
        }
        
        return new \Symfony\Component\HttpFoundation\Response();
    }

    /**
     * @Route("/refresh")
     */
    public function refreshAction() {
        $return = [];
        //http://overpass.osm.rambler.ru/cgi/interpreter?data=%5Bout:json%5D;node%5Bcraft_beer%3Dyes%5D%3Bout%3B
        $osm = new Guzzle('http://overpass-api.de/api');
        $response = $osm->get('xapi?*[craft_beer=yes]')->send();
        
        
        $locationsCollection = $this->getMongoCollection('CraftLocationBundle:Location');
        $dm = $locationsCollection->getDocumentManager();
        if ($response->getStatusCode() == 200) {
            $body = $response->getBody();
            echo $body;
            $results = new \DOMDocument();
            $results->loadXML($body);
            $resultsArray = [];
            $xpathDoc = new \DOMXPath($results);
            foreach ($xpathDoc->query('*[tag[@k="name"]]') as $location) {
                $id = (int)$location->getAttribute('id');
                $locationDbObject = $locationsCollection->findOneBy(['osmId' => $id]);
                if($locationDbObject === null) {
                    $locationDbObject = new \Craft\LocationBundle\Document\Location();
                    $locationDbObject->setOsmId($id);
                    $locationDbObject->setCreated(new Document\User(new \Craft\UserBundle\Document\User(), $_SERVER['REMOTE_ADDR']));
                }
                $tags = [];
                foreach ($location->getElementsByTagName('tag') as $tag) {
                    $tags[(string) $tag->getAttribute('k')] = (string) $tag->getAttribute('v');
                }
                $geolocation = [];
                if($location->hasAttribute('lat')&& $location->hasAttribute('lon')) {
                    $geolocation[] = ['lat' => $location->getAttribute('lat'), 'lon' => $location->getAttribute('lon')];
                } else {
                    foreach($location->getElementsByTagName('nd') as $nd) {
                        $nid = $nd->getAttribute('ref');
                        $refNode = $xpathDoc->query("//*[@id='$nid']")->item(0);
                        $geolocation[] = ['lat' => $refNode->getAttribute('lat'), 'lon' => $refNode->getAttribute('lon')];
                    }
                }
                $locationDbObject->populateOsmTags($tags);
                $locationDbObject->setCoordinates($geolocation);
                $dm->persist($locationDbObject);
            }
            $dm->flush();
        }
        
            return $return;
    }
    /** @Route("/add") **/
    public function addAction(\Symfony\Component\HttpFoundation\Request $request) {
        if($request->isMethod('POST')) {
            
        }
        
        $form = $this->createFormBuilder(new Document\Location())->getForm();
        return $form->createView();
        
    }
    
    /** @Route("/edit-osm/{value}") */
    public function editAction($value) {
        
        $location = $this->get('location_service')->findLocationByOsmId($value);
        
        $form = $this->createForm($location);
        
        echo $form;
    }
    
    /**
     * 
     * @param string $repository
     * @return \Doctrine\ODM\MongoDB\DocumentRepository
     */
    protected function getMongoCollection($repository) {
        $rep =  $this->get('doctrine_mongodb')->getRepository($repository);
        
        return $rep;
    }

}
