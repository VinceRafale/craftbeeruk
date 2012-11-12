<?php

namespace Craft\Location\Bundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;
/**
 * @MongoDB\Document(collection="locations")
 */
class Location {
    
    /**  @MongDB\Id */
    protected $id;
    
    /** @MongoDB\Int */
    protected $osmId;
    
    /** @MongoDB\EmbedMany(targetDocument="Coordinates") */
    protected $coordinates = [];
    
    /** @MongoDB\String */
    protected $real_ale;
    
    /** @MongoDB\String */
    protected $real_cider;
    
    /** @MongoDB\String */
    protected $website;
    
    /** @MongoDB\String */
    protected $email;
    
    /** @MongoDB\Date */
    protected $date;
    
    
}
