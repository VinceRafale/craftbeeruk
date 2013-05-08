<?php

namespace Craft\LocationBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/** @MongoDB\Document(collection="locationsHistory") */
class LocationHistory {
    
    /** @MongoDB\Id */
    protected $id;
    
    /** @MongoDB\EmbedOne(targetDocument="Location") */
    protected $location;
    
    /** @MongoDB\Date */
    protected $timestamp;
    
    public function __construct(Document\Location $document = null) {
        $this->setTimestamp(new \DateTime());
        $this->setLocation($document);
    }

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
     * Set location
     *
     * @param Craft\LocationBundle\Document\Location $location
     * @return \LocationHistory
     */
    public function setLocation(\Craft\LocationBundle\Document\Location $location)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * Get location
     *
     * @return Craft\LocationBundle\Document\Location $location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set timestamp
     *
     * @param date $timestamp
     * @return \LocationHistory
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    /**
     * Get timestamp
     *
     * @return date $timestamp
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }
}
