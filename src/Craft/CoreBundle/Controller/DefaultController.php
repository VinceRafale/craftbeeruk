<?php

namespace Craft\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @route("/")
     */
    public function indexAction() {
        
        return $this->render('CraftCoreBundle:Default:index.html.twig');
    }
    
    /**
     * @route("/wtf")
     */
    public function whatAction() {
        return $this->render('CraftCoreBundle:Default:what.html.twig');
    
    }
}
