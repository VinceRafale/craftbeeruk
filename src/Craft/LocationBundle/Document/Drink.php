<?php
/**
 * Author: rick
 * Date: 12/11/2013
 * Time: 15:33
 */

namespace Craft\LocationBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\EmbeddedDocument
 */
class Drink
{
    /** @MongoDB\Boolean */
    protected $available;

    /** @MongoDB\string */
    protected $description;


    public function __construct()
    {
        $this->available = false;
    }

    /**
     * Set available
     *
     * @param boolean $available
     * @return self
     */
    public function setAvailable($available)
    {
        $this->available = $available;
        return $this;
    }

    /**
     * Get available
     *
     * @return boolean $available
     */
    public function getAvailable()
    {
        return $this->available;
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
}
