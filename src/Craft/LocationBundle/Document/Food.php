<?php
/**
 * Author: rick
 * Date: 15/11/2013
 * Time: 12:46
 */

namespace Craft\LocationBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\EmbeddedDocument
 */
class Food
{
    /** @MongoDB\Boolean */
    protected $available;

    /** @MongoDB\String */
    protected $description;

    /** @MongoDB\EmbedOne(targetDocument="OpeningTimes") */
    protected $kitchenOpening;

    /** @MongoDB\String */
    protected $menu;

    public function __construct()
    {
        $this->available = false;
    }


    /**
     * Set available
     *
     * @param boolean $available
     * @return self
     */
    public function setAvailable($available)
    {
        $this->available = $available;
        return $this;
    }

    /**
     * Get available
     *
     * @return boolean $available
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set kitchenOpening
     *
     * @param Craft\LocationBundle\Document\OpeningTimes $kitchenOpening
     * @return self
     */
    public function setKitchenOpening(\Craft\LocationBundle\Document\OpeningTimes $kitchenOpening)
    {
        $this->kitchenOpening = $kitchenOpening;
        return $this;
    }

    /**
     * Get kitchenOpening
     *
     * @return Craft\LocationBundle\Document\OpeningTimes $kitchenOpening
     */
    public function getKitchenOpening()
    {
        return $this->kitchenOpening;
    }

    /**
     * Set menu
     *
     * @param string $menu
     * @return self
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;
        return $this;
    }

    /**
     * Get menu
     *
     * @return string $menu
     */
    public function getMenu()
    {
        return $this->menu;
    }
}
