<?php

namespace Craft\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PagesController extends Controller
{
    /**
     * @route("/")
     */
    public function indexAction()
    {
        /** @var \Craft\LocationBundle\Services\Location $locationService */
        $locationService = $this->get('location_service');
        $latest = $locationService->getLatest();
        return $this->render('CraftCoreBundle:Pages:index.html.twig', ['latest' => $latest]);
    }

    /**
     * @route("/wtf")
     */
    public function whatAction()
    {
        return $this->render('CraftCoreBundle:Pages:what.html.twig');

    }
}
