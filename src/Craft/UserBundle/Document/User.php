<?php

namespace Craft\UserBundle\Document;

use FOS\UserBundle\Document\User as BaseUser;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class User extends BaseUser {
    
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;
    
    /**
     * @MongoDB\String
     */
    protected $twitter_username;
    
    /**
     * @MongoDB\String
     */
    protected $twitterID;
    
    
    public function __construct() {
        parent::__construct();
        
    }

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }
}
