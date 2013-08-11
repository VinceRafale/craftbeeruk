<?php

namespace Craft\LocationBundle\Model;

class Outlet implements \JsonSerializable
{
    protected $id;
    protected $osmId;
    protected $name;
    protected $slug;
    
    /** @var \Ricklab\Location\Point The Location */
    protected $location;
    
    protected $distance;
    
    protected $caskLines;
    
    protected $kegLines;
    
    protected $bottleRange;
    
    


    public function jsonSerialize()
    {
        ;
    }
}
