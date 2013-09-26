<?php

namespace Craft\LocationBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;

/**
 * @MongoDB\EmbeddedDocument
 */
class Geolocation implements \JsonSerializable {
    
    /** @MongoDB\String */
    public $type;
    
    /** @MongoDB\Collection */
    public $coordinates = [];
    

    public function fromLocation($location) {
        if($location instanceof \JsonSerializable) {
            $serialise = $location->jsonSerialize();
            $this->type = $serialise['type'];
            $this->coordinates = $serialise['coordinates'];
        }
    }
    
    public static function fromGeoJson($location) {
        if(is_string($location)) {
            $location = json_decode($location);
        }
        
        $geolocation = new self();
        $geolocation->type = $location->type;
        $geolocation->coordinates = $location->coordinates;
        
        return $geolocation;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set coordinates
     *
     * @param float $coordinates
     * @return self
     */
    public function setCoordinates($coordinates)
    {
        $this->coordinates = $coordinates;
        return $this;
    }

    /**
     * Get coordinates
     *
     * @return float $coordinates
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }
    
    public function jsonSerialize()
    {
        return [
            'type' => $this->type,
            'coordinates' => $this->coordinates
        ];
    }
    
    public function __toString()
    {
        return json_encode($this);
    }
}
