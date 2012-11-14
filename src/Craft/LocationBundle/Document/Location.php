<?php

namespace Craft\LocationBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;
use Craft\UserBundle\Document as User;

/**
 * @MongoDB\Document(collection="locations")
 * @MongoDB\Index(keys={"coordinates"="2d", "centre"="2d"})
 */
class Location {

    /**
     * @MongoDB\Id 
     * 
     * @MongoDBUnique(fields="osmId")
     */
    protected $id;

    /**
     * @MongoDB\Int
     */
    protected $osmId;

    /** @MongoDB\String */
    protected $name;

    /** @MongoDB\String */
    protected $amenity;

    /** @MongoDB\EmbedMany(targetDocument="Coordinates") */
    protected $coordinates = [];

    /** @MongoDB\EmbedOne(targetDocument="Coordinates") */
    protected $centre;

    /** @MongoDB\Boolean */
    protected $real_ale;

    /** @MongoDB\Boolean */
    protected $real_cider;

    /** @MongoDB\String */
    protected $website;

    /** @MongoDB\String */
    protected $email;

    /** @MongoDB\String */
    protected $phone;

    /** @MongoDB\String */
    protected $address;

    /** @MongoDB\Date */
    protected $updated;

    /** @MongoDB\Date */
    protected $created;

    /** @MongoDB\ReferenceOne(targetDocument="Craft\UserBundle\Document\User") */
    protected $updatedBy;
    
    /** @MongoDB\Int */
    protected $caskLines;
    
    /** @MongoDB\Int */
    protected $kegLines;
    
    /** @MongoDB\String */
    protected $caskDispense;

    /** @MongoDB\EmbedMany(targetDocument="Regulars") */
    protected $regularBeers;

    /** @MongoDB\EmbedMany(targetDocument="Regulars") */
    protected $regularBreweries;

    public function __construct() {
        $this->coordinates = new \Doctrine\Common\Collections\ArrayCollection();
        $this->regularBeers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->regularBreweries = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set osmId
     *
     * @param int $osmId
     * @return Location
     */
    public function setOsmId($osmId) {
        $this->osmId = $osmId;
        return $this;
    }

    /**
     * Get osmId
     *
     * @return int $osmId
     */
    public function getOsmId() {
        return $this->osmId;
    }

    /**
     * Add coordinates
     *
     * @param Craft\LocationBundle\Document\Coordinates $coordinates
     */
    public function addCoordinates(\Craft\LocationBundle\Document\Coordinates $coordinates) {
        $this->coordinates[] = $coordinates;
        $this->updateCentre();
        return $this;
    }

    public function setCoordinates(Array $coords) {
        $this->coordinates = [];
        $this->centre = null;
        foreach ($coords as $i) {
            $c = new Coordinates();
            $c->latitude = $i['lat'];
            $c->longitude = $i['lon'];
            $this->addCoordinates($c);
        }
    }

    protected function updateCentre() {
        $latSum = 0;
        $lonSum = 0;
        foreach ($this->coordinates as $coordinate) {
            $latSum += $coordinate->getLatitude();
            $lonSum += $coordinate->getLongitude();
        }

        $latAverage = $latSum / count($this->coordinates);
        $lonAverage = $lonSum / count($this->coordinates);

        $centre = new Coordinates();
        $centre->setLatitude($latAverage);
        $centre->setLongitude($lonAverage);
        $this->setCentre($centre);
        return $this;
    }

    /**
     * Get coordinates
     *
     * @return Doctrine\Common\Collections\Collection $coordinates
     */
    public function getCoordinates() {
        return $this->coordinates;
    }

    /**
     * Set centre
     *
     * @param Craft\LocationBundle\Document\Coordinates $centre
     * @return Location
     */
    protected function setCentre(\Craft\LocationBundle\Document\Coordinates $centre) {
        $this->centre = $centre;
        return $this;
    }

    /**
     * Get centre
     *
     * @return Craft\LocationBundle\Document\Coordinates $centre
     */
    public function getCentre() {
        return $this->centre;
    }

    /**
     * Set real_ale
     *
     * @param boolean $realAle
     * @return Location
     */
    public function setRealAle($realAle) {
        $this->real_ale = $realAle;
        return $this;
    }

    /**
     * Get real_ale
     *
     * @return boolean $realAle
     */
    public function getRealAle() {
        return $this->real_ale;
    }

    /**
     * Set real_cider
     *
     * @param boolean $realCider
     * @return Location
     */
    public function setRealCider($realCider) {
        $this->real_cider = $realCider;
        return $this;
    }

    /**
     * Get real_cider
     *
     * @return boolean $realCider
     */
    public function getRealCider() {
        return $this->real_cider;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return Location
     */
    public function setWebsite($website) {
        $this->website = $website;
        return $this;
    }

    /**
     * Get website
     *
     * @return string $website
     */
    public function getWebsite() {
        return $this->website;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Location
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string $email
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set updated
     *
     * @param date $updated
     * @return Location
     */
    public function setUpdated($updated) {
        $this->updated = $updated;
        return $this;
    }

    /**
     * Get updated
     *
     * @return date $updated
     */
    public function getUpdated() {
        return $this->updated;
    }

    /**
     * Set created
     *
     * @param date $created
     * @return Location
     */
    public function setCreated($created) {
        $this->created = $created;
        return $this;
    }

    /**
     * Get created
     *
     * @return date $created
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * Set updatedBy
     *
     * @param Craft\UserBundle\Document\User $updatedBy
     * @return Location
     */
    public function setUpdatedBy(\Craft\UserBundle\Document\User $updatedBy) {
        $this->updatedBy = $updatedBy;
        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return Craft\UserBundle\Document\User $updatedBy
     */
    public function getUpdatedBy() {
        return $this->updatedBy;
    }

    /**
     * Add regularBeers
     *
     * @param Craft\LocationBundle\Document\Regulars $regularBeers
     */
    public function addRegularBeers(\Craft\LocationBundle\Document\Regulars $regularBeers) {
        $this->regularBeers[] = $regularBeers;
    }

    /**
     * Get regularBeers
     *
     * @return Doctrine\Common\Collections\Collection $regularBeers
     */
    public function getRegularBeers() {
        return $this->regularBeers;
    }

    /**
     * Add regularBreweries
     *
     * @param Craft\LocationBundle\Document\Regulars $regularBreweries
     */
    public function addRegularBreweries(\Craft\LocationBundle\Document\Regulars $regularBreweries) {
        $this->regularBreweries[] = $regularBreweries;
    }

    /**
     * Get regularBreweries
     *
     * @return Doctrine\Common\Collections\Collection $regularBreweries
     */
    public function getRegularBreweries() {
        return $this->regularBreweries;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Location
     */
    public function setPhone($phone) {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Get phone
     *
     * @return string $phone
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Location
     */
    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    /**
     * Get address
     *
     * @return string $address
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Location
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set amenity
     *
     * @param string $amenity
     * @return Location
     */
    public function setAmenity($amenity) {
        $this->amenity = $amenity;
        return $this;
    }

    /**
     * Get amenity
     *
     * @return string $amenity
     */
    public function getAmenity() {
        return $this->amenity;
    }

    /**
     * Populates the properties from OSM tags
     * @param array $tags
     */
    public function populateOsmTags(array $tags) {
        $this->setName($tags['name']);
        if(isset($tags['amenity'])) $this->setAmenity($tags['amenity']);
        $this->setRealCider(isset($tags['real_cider']) && $tags['real_cider'] === 'yes');
        $this->setRealAle(isset($tags['real_ale']) && $tags['real_ale'] === 'yes');
        if(isset($tags['email'])) $this->setEmail($tags['email']);
        if(isset($tags['contact:website'])) $this->setWebsite($tags['contact:website']);
        if(isset($tags['website'])) $this->setWebsite($tags['website']);
        
        $address = [];
        if(isset($tags['addr:housename'])) $address[] = $tags['addr:housename'];
        if(isset($tags['addr:housenumber'])) $address[] = $tags['addr:housenumber'];
        if(isset($tags['addr:street'])) $address[] = $tags['addr:street'];
        if(isset($tags['addr:city'])) $address[] = $tags['addr:city'];
        if(isset($tags['addr:postcode'])) $address[] = $tags['addr:postcode'];
        $address = implode("\n", $address);
        if($address !== '') $this->setAddress($address);
        if(isset($tags['phone'])) $this->setWebsite($tags['phone']);
        
    }


    /**
     * Set caskLines
     *
     * @param int $caskLines
     * @return Location
     */
    public function setCaskLines($caskLines)
    {
        $this->caskLines = $caskLines;
        return $this;
    }

    /**
     * Get caskLines
     *
     * @return int $caskLines
     */
    public function getCaskLines()
    {
        return $this->caskLines;
    }

    /**
     * Set kegLines
     *
     * @param int $kegLines
     * @return Location
     */
    public function setKegLines($kegLines)
    {
        $this->kegLines = $kegLines;
        return $this;
    }

    /**
     * Get kegLines
     *
     * @return int $kegLines
     */
    public function getKegLines()
    {
        return $this->kegLines;
    }

    /**
     * Set caskDispense
     *
     * @param string $caskDispense
     * @return Location
     */
    public function setCaskDispense($caskDispense)
    {
        $this->caskDispense = $caskDispense;
        return $this;
    }

    /**
     * Get caskDispense
     *
     * @return string $caskDispense
     */
    public function getCaskDispense()
    {
        return $this->caskDispense;
    }
}
