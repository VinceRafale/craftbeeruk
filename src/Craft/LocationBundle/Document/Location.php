<?php

namespace Craft\LocationBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;

/**
 * @MongoDB\Document(collection="locations", repositoryClass="Craft\LocationBundle\Document\LocationRepository")
 * @MongoDB\Index(keys={"geolocation"="2dsphere"})
 *
 * @MongoDBUnique(fields="osmId")
 */
class Location
{

    /**
     * @MongoDB\Id
     *
     */
    protected $id;

    /**
     * @MongoDB\Int
     * @MongoDB\Index
     */
    protected $osmId;

    /** @MongoDB\String */
    protected $name;

    /**
     *
     * @MongoDB\String
     * @MongoDB\Index
     */
    protected $slug;

    /**
     * @MongoDB\String
     * @MongoDB\Index
     */
    protected $outlet;

    /** @MongoDB\EmbedOne(targetDocument="Geolocation") */
    protected $geolocation;

    /** @MongoDB\Distance */
    protected $distance;

    /** @MongoDB\String */
    protected $description;

    /** @MongoDB\EmbedOne(targetDocument="OpeningTimes") */
    protected $opening;

    /** @MongoDB\EmbedOne(targetDocument="Drink") */
    protected $cider;

    /** @MongoDB\String */
    protected $website;

    /** @MongoDB\String */
    protected $email;

    /** @MongoDB\String */
    protected $phone;

    /** @MongoDB\String */
    protected $address;

    /** @MongoDB\EmbedMany(targetDocument="User") */
    protected $updated = [];

    /** @MongoDB\EmbedOne(targetDocument="User") */
    protected $created;

    /** @MongoDB\EmbedOne(targetDocument="Drink") */
    protected $cask;

    /** @MongoDB\EmbedOne(targetDocument="Drink") */
    protected $keg;

    /** @MongoDB\EmbedOne(targetDocument="Drink") */
    protected $bottleSelection;

    /** @MongoDB\Collection */
    protected $beerOrigins = [];

    /** @MongoDB\EmbedOne(targetDocument="OpeningTimes") */
    protected $openingTimes;

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
     * Set osmId
     *
     * @param int $osmId
     * @return Location
     */
    public function setOsmId($osmId)
    {
        $this->osmId = $osmId;
        return $this;
    }

    /**
     * Get osmId
     *
     * @return int $osmId
     */
    public function getOsmId()
    {
        return $this->osmId;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return Location
     */
    public function setWebsite($website)
    {
        $this->website = $website;
        return $this;
    }

    /**
     * Get website
     *
     * @return string $website
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Location
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Location
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Get phone
     *
     * @return string $phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Location
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * Get address
     *
     * @return string $address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Location
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
     * Populates the properties from OSM tags
     * @param array $tags
     */
    public function populateOsmTags(array $tags)
    {
        $this->setName($tags['name']);
        if (isset($tags['amenity'])) {
            $this->setAmenity($tags['amenity']);
        }
        $this->setRealCider(isset($tags['real_cider']) && $tags['real_cider'] === 'yes');
        $this->setRealAle(isset($tags['real_ale']) && $tags['real_ale'] === 'yes');
        if (isset($tags['email'])) {
            $this->setEmail($tags['email']);
        }
        if (isset($tags['contact:website'])) {
            $this->setWebsite($tags['contact:website']);
        }
        if (isset($tags['website'])) {
            $this->setWebsite($tags['website']);
        }

        $address = [];
        if (isset($tags['addr:housename'])) {
            $address[] = $tags['addr:housename'];
        }
        if (isset($tags['addr:housenumber'])) {
            $address[] = $tags['addr:housenumber'];
        }
        if (isset($tags['addr:street'])) {
            $address[] = $tags['addr:street'];
        }
        if (isset($tags['addr:city'])) {
            $address[] = $tags['addr:city'];
        }
        if (isset($tags['addr:postcode'])) {
            $address[] = $tags['addr:postcode'];
        }
        $address = implode("\n", $address);
        if ($address !== '') {
            $this->setAddress($address);
        }
        if (isset($tags['phone'])) {
            $this->setWebsite($tags['phone']);
        }

    }

    /**
     * Set distance
     *
     * @param string $distance
     * @return \Location
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;
        return $this;
    }

    /**
     * Get distance
     *
     * @return string $distance
     */
    public function getDistance()
    {
        return $this->distance;
    }


    /**
     * Set slug
     *
     * @param string $slug
     * @return \Location
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Get slug
     *
     * @return string $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add updated
     *
     * @param \Craft\LocationBundle\Document\User $updated
     */
    public function addUpdated(\Craft\LocationBundle\Document\User $updated)
    {
        $this->updated[] = $updated;
    }

    /**
     * Get updated
     *
     * @return \Doctrine\Common\Collections\Collection $updated
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set created
     *
     * @param \Craft\LocationBundle\Document\User $created
     * @return \Location
     */
    public function setCreated(\Craft\LocationBundle\Document\User $created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * Get created
     *
     * @return \Craft\LocationBundle\Document\User $created
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Add coordinates
     *
     * @param \Craft\LocationBundle\Document\Coordinates $coordinates
     */
    public function addCoordinate(\Craft\LocationBundle\Document\Coordinates $coordinates)
    {
        $this->coordinates[] = $coordinates;
    }

    /**
     * Remove updated
     *
     * @param <variableType$updated
     */
    public function removeUpdated(\Craft\LocationBundle\Document\User $updated)
    {
        $this->updated->removeElement($updated);
    }

    /**
     * Set outlet
     *
     * @param string $outlet
     * @return self
     */
    public function setOutlet($outlet)
    {
        $this->outlet = $outlet;
        return $this;
    }

    /**
     * Get outlet
     *
     * @return string $outlet
     */
    public function getOutlet()
    {
        return $this->outlet;
    }


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
     * Set geolocation
     *
     * @param \Craft\LocationBundle\Document\Geolocation $geolocation
     * @return self
     */
    public function setGeolocation($geolocation)
    {
        if ($geolocation instanceof Geolocation) {
            $this->geolocation = $geolocation;
            return $this;
        }

        $geolocation = Geolocation::fromGeoJson($geolocation);

        $this->geolocation = $geolocation;
        return $this;
    }

    /**
     * Get geolocation
     *
     * @return \Craft\LocationBundle\Document\Geolocation $geolocation
     */
    public function getGeolocation()
    {
        return $this->geolocation;
    }

    public function __construct()
    {
        $this->updated = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set opening
     *
     * @param Craft\LocationBundle\Document\OpeningTimes $opening
     * @return self
     */
    public function setOpening(\Craft\LocationBundle\Document\OpeningTimes $opening)
    {
        $this->opening = $opening;
        return $this;
    }

    /**
     * Get opening
     *
     * @return Craft\LocationBundle\Document\OpeningTimes $opening
     */
    public function getOpening()
    {
        return $this->opening;
    }

    /**
     * Set caskInfo
     *
     * @param string $caskInfo
     * @return self
     */
    public function setCaskInfo($caskInfo)
    {
        $this->caskInfo = $caskInfo;
        return $this;
    }

    /**
     * Get caskInfo
     *
     * @return string $caskInfo
     */
    public function getCaskInfo()
    {
        return $this->caskInfo;
    }

    /**
     * Set kegInfo
     *
     * @param string $kegInfo
     * @return self
     */
    public function setKegInfo($kegInfo)
    {
        $this->kegInfo = $kegInfo;
        return $this;
    }

    /**
     * Get kegInfo
     *
     * @return string $kegInfo
     */
    public function getKegInfo()
    {
        return $this->kegInfo;
    }

    /**
     * Set bottleSelection
     *
     * @param boolean $bottleSelection
     * @return self
     */
    public function setBottleSelection($bottleSelection)
    {
        $this->bottleSelection = $bottleSelection;
        return $this;
    }

    /**
     * Get bottleSelection
     *
     * @return boolean $bottleSelection
     */
    public function getBottleSelection()
    {
        return $this->bottleSelection;
    }

    /**
     * Set bottleInfo
     *
     * @param string $bottleInfo
     * @return self
     */
    public function setBottleInfo($bottleInfo)
    {
        $this->bottleInfo = $bottleInfo;
        return $this;
    }

    /**
     * Get bottleInfo
     *
     * @return string $bottleInfo
     */
    public function getBottleInfo()
    {
        return $this->bottleInfo;
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
     * Set openingTimes
     *
     * @param Craft\LocationBundle\Document\OpeningTimes $openingTimes
     * @return self
     */
    public function setOpeningTimes(\Craft\LocationBundle\Document\OpeningTimes $openingTimes)
    {
        $this->openingTimes = $openingTimes;
        return $this;
    }

    /**
     * Get openingTimes
     *
     * @return Craft\LocationBundle\Document\OpeningTimes $openingTimes
     */
    public function getOpeningTimes()
    {
        return $this->openingTimes;
    }
}
