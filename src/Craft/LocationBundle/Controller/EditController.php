<?php

namespace Craft\LocationBundle\Controller;

use Craft\LocationBundle\Document\Drinks;
use Craft\LocationBundle\Document\Food;
use Craft\LocationBundle\Document\Location;
use Craft\LocationBundle\Document\OpeningTimes;
use Craft\LocationBundle\Document\User;
use Craft\LocationBundle\Form\Type\DrinksType;
use Craft\LocationBundle\Form\Type\LocationType;
use Craft\LocationBundle\Form\Type\OpeningTimesType;
use Craft\LocationBundle\Form\Type\FoodType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class EditController
 * @package Craft\LocationBundle\Controller
 * @Route("/edit")
 *
 * @ParamConverter("location",class="CraftLocationBundle:Location", options={"mapping":{"slug" : "slug"}})
 */
class EditController extends Controller
{
    /**
     * @Route("/general/{slug}")
     * @Template("CraftLocationBundle:Location:add.html.twig")
     */
    public function generalAction(Location $location, Request $request)
    {
        $form = $this->createForm(new LocationType(), $location);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->addUpdatedUser($location);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToView($location);
        }

        return ['form' => $form->createView(), 'headline' => 'General Information'];

    }

    /**
     * @Route("/drinks/{slug}")
     * @Template("CraftLocationBundle:Edit:edit.html.twig")
     */
    public function drinksAction(Location $location, Request $request)
    {
        if ($location->getDrinks() === null) {
            $location->setDrinks(new Drinks());
        }
        $form = $this->createForm(new DrinksType(), $location->getDrinks());

        $form->handleRequest($request);

        if ($form->get('remove')->isClicked()) {
            $location->setDrinks(null);
            $this->get('location_service')->updateLocation($location, $this->getUser(), $request);

            return $this->redirectToView($location);
        }

        if ($form->isValid()) {
            $this->get('location_service')->updateLocation($location, $this->getUser(), $request);
            return $this->redirectToView($location);
        }

        return ['form' => $form->createView(), 'headline' => 'Drinks'];
    }

    /**
     * @Route("/food/{slug}")
     * @Template("CraftLocationBundle:Edit:edit.html.twig")
     */
    public function foodAction(Location $location, Request $request)
    {
        if ($location->getFood() === null) {
            $location->setFood(new Food());
        }
        $form = $this->createForm(new FoodType(), $location->getFood());

        $form->handleRequest($request);

        if ($form->get('remove')->isClicked()) {
            $location->setFood(null);
            $this->get('location_service')->updateLocation($location, $this->getUser(), $request);

            return $this->redirectToView($location);
        }

        if ($form->isValid()) {
            $this->get('location_service')->updateLocation($location, $this->getUser(), $request);
            return $this->redirectToView($location);
        }

        return ['form' => $form->createView(), 'headline' => 'Food'];

    }

    /**
     * @Route("/opening/{slug}")
     * @Template("CraftLocationBundle:Edit:edit.html.twig")
     */
    public function openingAction(Location $location, Request $request)
    {
        if ($location->getOpeningTimes() === null) {
            $location->setOpeningTimes(new OpeningTimes());
        }

        $form = $this->createForm(new OpeningTimesType(), $location->getOpeningTimes());
        $form->handleRequest($request);

        if ($form->get('remove')->isClicked()) {
            $location->setOpeningTimes(null);
            $this->get('location_service')->updateLocation($location, $this->getUser(), $request);

            return $this->redirectToView($location);
        }

        if ($form->isValid()) {
            $this->get('location_service')->updateLocation($location, $this->getUser(), $request);
            return $this->redirectToView($location);
        }

        return ['form' => $form->createView(), 'headline' => 'Opening Times'];

    }

    /**
     * @Route("/food-opening/{slug}")
     * @Template("CraftLocationBundle:Edit:edit.html.twig")
     */
    public function foodOpeningAction(Location $location, Request $request)
    {
        if ($location->getFood() === null) {
            $location->setFood(new Food());
        }
        if ($location->getFood()->getKitchenOpening() === null) {
            $location->getFood()->setKitchenOpening(new OpeningTimes());
        }

        $form = $this->createForm(new OpeningTimesType(), $location->getFood()->getKitchenOpening());
        $form->handleRequest($request);

        if ($form->get('remove')->isClicked()) {
            $location->getFood()->setKitchenOpening(null);
            $this->get('location_service')->updateLocation($location, $this->getUser(), $request);

            return $this->redirectToView($location);
        }

        if ($form->isValid()) {
            $this->get('location_service')->updateLocation($location, $this->getUser(), $request);
            return $this->redirectToView($location);
        }

        return ['form' => $form->createView(), 'headline' => 'Kitchen Opening'];

    }

    protected function redirectToView(Location $location)
    {
        return $this->redirect($this->generateUrl('craft_location_default_view', ['slug' => $location->getSlug()]));
    }

    protected function addUpdatedUser(Location $location)
    {
        $user = new User($this->getUser(), $this->getRequest()->getClientIp());
        $location->addUpdated($user);
    }

}
