<?php

namespace Craft\LocationBundle\Services;

use Craft\LocationBundle\Document;
use Ricklab\Location as Loc;
use Guzzle\Service\Client as Guzzle;

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
     * @param int $limit Limit the results to a number
     * @param int $offset Start from this item
     * @return \Doctrine\MongoDB\ArrayIterator
     */
    public function getLocationsAround(Loc\Point $point, $limit, $offset = 0) {
        $locations = $this->getMongoLocationCollection()
                        ->createQueryBuilder()
                        ->geoNear((float) $point->getLatitude(), (float) $point->getLongitude())
                        ->distanceMultiplier($this->radius)
                        ->spherical()
                        ->limit((int) $limit)
                        ->skip($offset)
                        ->getQuery()->execute();
        return $locations;
    }

    public function getOsmLocations(Loc\Mbr $mbr, $amenity, Array $tags = []) {
        $amenityString = '';
        if ($amenity !== null) {
            $amenityString = '["amenity"~"';
            if (is_array($amenity)) {
                $amenityString .= implode('|', $amenity);
            } else {
                $amenityString .= $amenity;
            }
            $amenityString .= '"]';
        }
        
        $tagString = '';
        
        $osm = new Guzzle('http://overpass-api.de/api');
        $response = $osm->get('xapi?*[craft_beer=yes]')->send();
    }

    public function updateLocation(Document\Location $location, \Craft\UserBundle\Document\User $user) {
        if ($location->getId() == null) {
            $this->insertLocation($location, $user);
        } else {
            $updateInfo = new Document\User($user, $_SERVER['REMOTE_ADDR']);
            $location->addUpdated($updateInfo);
            $oldDoc = new Document\LocationHistory($this->findLocation('id', $location->getId()));
            $this->doctrine->persist($oldDoc);
            $this->doctrine->flush();
        }

        return $this;
    }

    public function insertLocation(Document\Location $location, \Craft\UserBundle\Document\User $user) {
        
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
                ->getQuery()
                ->execute();

        return $location;
    }

    /**
     * 
     * @return \Doctrine\ODM\MongoDB\DocumentRepository
     */
    protected function getMongoLocationCollection() {
        $rep = $this->doctrine->getRepository('CraftLocationBundle:Location');

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