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
    
    /** @MongoDB\ReferenceOne(targetDocument="User\User") 
     * @MongoDB\Index
     */
    protected $author;
    
    /** @MongoDB\Int */
    protected $rating;
    
    /** @MongoDB\String */
    protected $comment;
    
    /** 
     * @MongoDB\DateTime
     * @MongoDB\Index
     */
    protected $created;
    
    /** @MongoDB\ReferenceMany(targetDocument="User\User" */
    protected $foundHelpful = [];
}