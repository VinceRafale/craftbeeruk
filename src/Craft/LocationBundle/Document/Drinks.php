<?php
/**
 * Author: rick
 * Date: 15/11/2013
 * Time: 15:46
 */

namespace Craft\LocationBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\EmbeddedDocument
 */
class Drinks
{

    /** @MongoDB\Collection */
    protected $beerOrigins = [];

    /** @MongoDB\EmbedOne(targetDocument="Drink") */
    protected $cask;

    /** @MongoDB\EmbedOne(targetDocument="Drink") */
    protected $keg;

    /** @MongoDB\EmbedOne(targetDocument="Drink") */
    protected $bottleSelection;

    /** @MongoDB\EmbedOne(targetDocument="Drink") */
    protected $cider;


    /**
     * Set beerOrigins
     *
     * @param collection $beerOrigins
     * @return self
     */
    public function setBeerOrigins($beerOrigins)
    {
        $this->beerOrigins = $beerOrigins;
        return $this;
    }

    /**
     * Get beerOrigins
     *
     * @return collection $beerOrigins
     */
    public function getBeerOrigins()
    {
        return $this->beerOrigins;
    }

    /**
     * Set cask
     *
     * @param Craft\LocationBundle\Document\Drink $cask
     * @return self
     */
    public function setCask(\Craft\LocationBundle\Document\Drink $cask)
    {
        $this->cask = $cask;
        return $this;
    }

    /**
     * Get cask
     *
     * @return Craft\LocationBundle\Document\Drink $cask
     */
    public function getCask()
    {
        return $this->cask;
    }

    /**
     * Set keg
     *
     * @param Craft\LocationBundle\Document\Drink $keg
     * @return self
     */
    public function setKeg(\Craft\LocationBundle\Document\Drink $keg)
    {
        $this->keg = $keg;
        return $this;
    }

    /**
     * Get keg
     *
     * @return Craft\LocationBundle\Document\Drink $keg
     */
    public function getKeg()
    {
        return $this->keg;
    }

    /**
     * Set bottleSelection
     *
     * @param Craft\LocationBundle\Document\Drink $bottleSelection
     * @return self
     */
    public function setBottleSelection(\Craft\LocationBundle\Document\Drink $bottleSelection)
    {
        $this->bottleSelection = $bottleSelection;
        return $this;
    }

    /**
     * Get bottleSelection
     *
     * @return Craft\LocationBundle\Document\Drink $bottleSelection
     */
    public function getBottleSelection()
    {
        return $this->bottleSelection;
    }

    /**
     * Set cider
     *
     * @param Craft\LocationBundle\Document\Drink $cider
     * @return self
     */
    public function setCider(\Craft\LocationBundle\Document\Drink $cider)
    {
        $this->cider = $cider;
        return $this;
    }

    /**
     * Get cider
     *
     * @return Craft\LocationBundle\Document\Drink $cider
     */
    public function getCider()
    {
        return $this->cider;
    }
}
