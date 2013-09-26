<?php

namespace Craft\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController as Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Routing\ClassResourceInterface;

class LocationController extends Controller implements ClassResourceInterface
{
    
    public function getAction($slug)
    {
        $view = View::create();
        
        $location = $this->get('location_service')->findLocationBySlug($slug);
        
        if($location) {
            $view->setStatusCode(200)->setData($location);
        } else {
            $view->setStatusCode(404);
        }
        return $this->handleView($view);
    }
    
   // public function cgetAction($latitude, $longitude, $limit) {
   //     $locations = $this->get('locations_service')->getLocationsAround();
   // }

}