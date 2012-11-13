<?php

namespace Craft\LocationBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;

/**
 * @MongoDB\EmbeddedDocument
 */
class Regulars {
    
    /** @MongoDB\ReferenceOne */
    public $documentId;
    
    /** @MongoDB\String */
    public $regularity;
}