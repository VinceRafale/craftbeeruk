<?php

namespace Craft\LocationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class WelcomeController extends Controller {
    
    /**
     * @route("/")
     */
    
    public function indexAction() {
        
        return $this->render('CraftLocationBundle:Welcome:index.html.twig');
    }
}