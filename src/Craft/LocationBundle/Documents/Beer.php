<?php

namespace Craft\LocationBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;
use Craft\UserBundle\Document as User;

/**
 * @MongoDB\Document(collection="beers")
 */
class Beer {
    
    /** @MongoDB\Id */
    protected $id;
    
    /** @MongoDB\String */
    protected $name;
    
    /** 
     * @MongoDB\ReferenceOne(targetDocument="Location",simple=true) 
     * @MongoDB\Index
     */
    protected $breweryId;
    
    /** @MongoDB\ReferenceOne(targetDocument="User\User") */
    protected $addedBy;
    
}