<?php

namespace Craft\LocationBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

class ApiController extends FOSRestController {
    
    /**
     * @Route("/api/get-locations/{latitude}/{longitude}/{limit}")
     */
    public function getLocationsAction($latitude, $longitude, $limit){
        $point  = new Location\Point((float)$latitude, (float)$longitude);
        $locations = $this->get('location_service')->getLocationsAround($point, $limit);
        
        $view = $this->view($locations, 200);
        return $this->handleView($view);
    }
    
    
    public function getLocation() {
        
    }
    
    public function postLocation() {
        
    }
    
    public function putLocation() {
        
    }
    
    public function deleteLocation() {
        
    }
    
}