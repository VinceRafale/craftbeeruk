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
    protected $exists;

    /** @MongoDB\string */
    protected $description;


    /**
     * Set exists
     *
     * @param boolean $exists
     * @return self
     */
    public function setExists($exists)
    {
        $this->exists = $exists;
        return $this;
    }

    /**
     * Get exists
     *
     * @return boolean $exists
     */
    public function getExists()
    {
        return $this->exists;
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
