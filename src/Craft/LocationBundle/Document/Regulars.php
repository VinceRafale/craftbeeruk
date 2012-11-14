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

    /**
     * Set documentId
     *
     * @param $documentId
     * @return Regulars
     */
    public function setDocumentId($documentId)
    {
        $this->documentId = $documentId;
        return $this;
    }

    /**
     * Get documentId
     *
     * @return $documentId
     */
    public function getDocumentId()
    {
        return $this->documentId;
    }

    /**
     * Set regularity
     *
     * @param string $regularity
     * @return Regulars
     */
    public function setRegularity($regularity)
    {
        $this->regularity = $regularity;
        return $this;
    }

    /**
     * Get regularity
     *
     * @return string $regularity
     */
    public function getRegularity()
    {
        return $this->regularity;
    }
}
