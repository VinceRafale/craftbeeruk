<?php

namespace Craft\LocationBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;
use Craft\UserBundle\Document as User;
/**
 * @MongoDB\Document(collection="comments")
 */
class Comment {
    
    /** @MongoDB\Id */
    protected $id;
    
    /**
     * @MongoDB\ReferenceOne(targetDocument="Location")
     * @MongoDB\Index
     */
    protected $location;
    
    /** @MongoDB\ReferenceOne(targetDocument="Craft\UserBundle\Document\User") 
     * @MongoDB\Index
     */
    protected $author;
    
    /** @MongoDB\Int */
    protected $rating;
    
    /** @MongoDB\String */
    protected $comment;
    
    /** 
     * @MongoDB\Date
     * @MongoDB\Index
     */
    protected $created;
    
    /** @MongoDB\ReferenceMany(targetDocument="Craft\UserBundle\Document\User") */
    protected $foundHelpful = [];
    public function __construct()
    {
        $this->foundHelpful = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Comment
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
     * Set author
     *
     * @param Craft\UserBundle\Document\User $author
     * @return Comment
     */
    public function setAuthor(\Craft\UserBundle\Document\User $author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * Get author
     *
     * @return Craft\UserBundle\Document\User $author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set rating
     *
     * @param int $rating
     * @return Comment
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
        return $this;
    }

    /**
     * Get rating
     *
     * @return int $rating
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return Comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * Get comment
     *
     * @return string $comment
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set created
     *
     * @param date $created
     * @return Comment
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * Get created
     *
     * @return date $created
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Add foundHelpful
     *
     * @param Craft\UserBundle\Document\User $foundHelpful
     */
    public function addFoundHelpful(\Craft\UserBundle\Document\User $foundHelpful)
    {
        $this->foundHelpful[] = $foundHelpful;
    }

    /**
     * Get foundHelpful
     *
     * @return Doctrine\Common\Collections\Collection $foundHelpful
     */
    public function getFoundHelpful()
    {
        return $this->foundHelpful;
    }

    /**
    * Remove foundHelpful
    *
    * @param <variableType$foundHelpful
    */
    public function removeFoundHelpful(\Craft\UserBundle\Document\User $foundHelpful)
    {
        $this->foundHelpful->removeElement($foundHelpful);
    }
}
