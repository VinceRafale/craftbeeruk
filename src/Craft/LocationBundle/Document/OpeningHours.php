<?php

namespace Craft\LocationBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\EmbeddedDocument
 */
class OpeningHours
{

    /** @MongoDB\String */
    protected $opens;

    /** @MongoDB\String */
    protected $closes;

    /** @MongoDB\Boolean */
    protected $closed;

    /**
     * Set opens
     *
     * @param string $opens
     * @return self
     */
    public function setOpens($opens)
    {
        $this->opens = $opens;
        return $this;
    }

    /**
     * Get opens
     *
     * @return string $opens
     */
    public function getOpens()
    {
        return $this->opens;
    }

    /**
     * Set closes
     *
     * @param string $closes
     * @return self
     */
    public function setCloses($closes)
    {
        $this->closes = $closes;
        return $this;
    }

    /**
     * Get closes
     *
     * @return string $closes
     */
    public function getCloses()
    {
        return $this->closes;
    }

    /**
     * Set closed
     *
     * @param boolean $closed
     * @return self
     */
    public function setClosed($closed)
    {
        $this->closed = $closed;
        return $this;
    }

    /**
     * Get closed
     *
     * @return boolean $closed
     */
    public function getClosed()
    {
        return $this->closed;
    }
}
