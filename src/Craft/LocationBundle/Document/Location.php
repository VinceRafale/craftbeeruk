<?php

namespace Craft\LocationBundle\Document;

use Doctrine\ODM\MongoDB\Event\PreUpdateEventArgs;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;

/**
 * @MongoDB\Document(collection="locations", repositoryClass="Craft\LocationBundle\Document\LocationRepository")
 * @MongoDB\Index(keys={"geolocation"="2dsphere"})
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

    /**
     * @MongoDB\String
     * @MongoDB\Index
     *
     */
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

    /** @MongoDB\String */
    protected $website;

    /** @MongoDB\String */
    protected $email;

    /** @MongoDB\String */
    protected $phone;

    /** @MongoDB\String */
    protected $address;

    /** @MongoDB\EmbedOne(targetDocument="Drinks") */
    protected $drinks;

    /** @MongoDB\EmbedOne(targetDocument="Food") */
    protected $food;

    /** @MongoDB\EmbedOne(targetDocument="OpeningTimes") */
    protected $openingTimes;

    /** @MongoDB\String */
    protected $twitter;

    /** @MongoDB\EmbedMany(targetDocument="User") */
    protected $updated = [];

    /** @MongoDB\EmbedOne(targetDocument="User") */
    protected $created;

    public function __construct()
    {
        $this->setFood(null);
        $this->setDrinks(null);
        $this->setOpeningTimes(null);

        $this->updated = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Remove updated
     *
     * @param \Craft\LocationBundle\Document\User $updated
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
     * Set openingTimes
     *
     * @param \Craft\LocationBundle\Document\OpeningTimes $openingTimes
     * @return self
     */
    public function setOpeningTimes($openingTimes)
    {
        $this->openingTimes = $openingTimes;
        return $this;
    }

    /**
     * Get openingTimes
     *
     * @return \Craft\LocationBundle\Document\OpeningTimes $openingTimes
     */
    public function getOpeningTimes()
    {
        return $this->openingTimes;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     * @return self
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
        return $this;
    }

    /**
     * Get twitter
     *
     * @return string $twitter
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set food
     *
     * @param \Craft\LocationBundle\Document\Food $food
     * @return self
     */
    public function setFood($food)
    {
        $this->food = $food;
        return $this;
    }

    /**
     * Get food
     *
     * @return \Craft\LocationBundle\Document\Food $food
     */
    public function getFood()
    {
        return $this->food;
    }

    public function isOpen(\DateTime $date = null)
    {
        if ($this->openingTimes === null) {
            return null;
        } else {
            return $this->openingTimes->isOpen($date);
        }
    }

    /**
     * Set drinks
     *
     * @param \Craft\LocationBundle\Document\Drinks $drinks
     * @return self
     */
    public function setDrinks($drinks)
    {
        $this->drinks = $drinks;
        return $this;
    }

    /**
     * Get drinks
     *
     * @return \Craft\LocationBundle\Document\Drinks $drinks
     */
    public function getDrinks()
    {
        return $this->drinks;
    }
}
