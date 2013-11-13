<?php

namespace Craft\LocationBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;
use Craft\UserBundle\Document as User;

/**
 * @MongoDB\Document(collection="beers")
 */
class Beer
{

    /** @MongoDB\Id */
    protected $id;

    /** @MongoDB\String */
    protected $name;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Location",simple=true)
     * @MongoDB\Index
     */
    protected $breweryId;

    /** @MongoDB\ReferenceOne(targetDocument="Craft\UserBundle\Document\User") */
    protected $addedBy;

    /** @MongoDB\Date */
    protected $added;


    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Beer
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set breweryId
     *
     * @param Craft\LocationBundle\Document\Location $breweryId
     * @return Beer
     */
    public function setBreweryId(\Craft\LocationBundle\Document\Location $breweryId)
    {
        $this->breweryId = $breweryId;
        return $this;
    }

    /**
     * Get breweryId
     *
     * @return Craft\LocationBundle\Document\Location $breweryId
     */
    public function getBreweryId()
    {
        return $this->breweryId;
    }

    /**
     * Set addedBy
     *
     * @param Craft\UserBundle\Document\User $addedBy
     * @return Beer
     */
    public function setAddedBy(\Craft\UserBundle\Document\User $addedBy)
    {
        $this->addedBy = $addedBy;
        return $this;
    }

    /**
     * Get addedBy
     *
     * @return Craft\UserBundle\Document\User $addedBy
     */
    public function getAddedBy()
    {
        return $this->addedBy;
    }

    /**
     * Set added
     *
     * @param date $added
     * @return Beer
     */
    public function setAdded($added)
    {
        $this->added = $added;
        return $this;
    }

    /**
     * Get added
     *
     * @return date $added
     */
    public function getAdded()
    {
        return $this->added;
    }
}
