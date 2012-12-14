<?php

namespace Craft\LocationBundle\Services;

use Craft\LocationBundle\Document;
use Ricklab\Location as Loc;

class Location {
    
    /**
     *
     * @var float 
     */
    protected $radius;
    
    /**
     *
     * @var string 
     */
    protected $unit;
    /**
     *
     * @var \Doctrine\ODM\MongoDB\DocumentManager 
     */
    protected $doctrine;
    
    /**
     * 
     * @param string $unit
     * @param \Doctrine\ODM\MongoDB\DocumentManager $doctrine
     */
    public function __construct($unit, \Doctrine\ODM\MongoDB\DocumentManager $doctrine) {
        $this->unit = $unit;
        $this->radius = Loc\Earth::radius($unit);
        $this->doctrine = $doctrine;
    }
    
   
    /**
     * 
     * @param \Ricklab\Location\Point $point
     * @param int $limit
     * @return \Doctrine\MongoDB\ArrayIterator
     */
    public function getLocationsAround(Loc\Point $point, $limit) {
           $locations = $this->getMongoLocationCollection()
                   ->createQueryBuilder()
                   ->geoNear((float)$point->getLatitude(), (float)$point->getLongitude())
                   ->distanceMultiplier($this->radius)
                   ->spherical()
                   ->limit((int)$limit)
                ->getQuery()->execute();
           return $locations;
    }
    
    public function updateLocation(Document\Location $location, \Craft\UserBundle\Document\User $user) {
        $location->setUpdated(new \DateTime());
        $location->setUpdatedBy($user);
        $this->doctrine->flush($location);
    }
    
    /**
     * 
     * @param type $slug
     * @return \Craft\LocationBundle\Document\Location
     */
    public function findLocationBySlug($slug) {
        return $this->findLocation('slug', $slug);
    }
    
    public function findLocationByOsmId($osmId) {
        return $this->findLocation('osmId', $osmId);
    }
    
    /**
     * 
     * @param string $field
     * @param string $value
     * @return \Craft\LocationBundle\Document\Location
     */
    public function findLocation($field, $value) {
        $rep = $this->getMongoLocationCollection();
        $location = $rep->createQueryBuilder()
                ->findOneBy([$field => $value])
                ->sort('updated', 'desc')
                ->getQuery()
                ->execute();
        
        return $location;
    }
    
    /**
     * 
     * @return \Doctrine\ODM\MongoDB\DocumentRepository
     */
    protected function getMongoLocationCollection() {
        $rep =  $this->doctrine->getRepository('CraftLocationBundle:Location');
        
        return $rep;
    }
    
    /**
     * 
     * @return float
     */
    public function getRadius() {
        return $this->radius;
    }
    
    /**
     * 
     * @return string
     */
    public function getUnit() {
        return $this->unit;
    }

}