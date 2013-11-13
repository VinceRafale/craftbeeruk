<?php

namespace Craft\LocationBundle\Document;


/**
 * Craft\LocationBundle\Document\Coordinates
 */
class Coordinates
{
    /**
     * @var string $type
     */
    protected $type;

    /**
     * @var float $coordinates
     */
    protected $coordinates;


    /**
     * Set type
     *
     * @param string $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set coordinates
     *
     * @param float $coordinates
     * @return self
     */
    public function setCoordinates($coordinates)
    {
        $this->coordinates = $coordinates;
        return $this;
    }

    /**
     * Get coordinates
     *
     * @return float $coordinates
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }
}