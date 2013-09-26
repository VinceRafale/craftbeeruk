<?php

namespace Craft\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CraftApiBundle:Default:index.html.twig', array('name' => $name));
    }
}
