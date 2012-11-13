<?php

namespace Craft\LocationBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;
/**
 * @MongoDB\Document(collection="locations")
 * @MongoDB\Index(keys={"coordinates"="2d", "centre"="2d"})
 */
class Location {
    
    /**  @MongDB\Id */
    protected $id;
    
    /** @MongoDB\Int */
    protected $osmId;
    
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
    
    /** @MongoDB\Date */
    protected $date;
    
    /** @MongoDB\EmbedMany(targetDocument="Regulars") */
    protected $regularBeers;
    
    /** @MongoDB\EmbedMany(targetDocument="Regulars") */
    protected $regularBreweries;
    
    
    
}
