<?php

namespace Craft\UserBundle\Document;

//use FOS\UserBundle\Document\User as BaseUser;
use Sonata\UserBundle\Document\BaseUser as BaseUser;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * @MongoDB\Document
 * @ExclusionPolicy("all")
 */
class User extends BaseUser
{

    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @var string
     * @Expose
     */
    protected $username;

    /**
     * @MongoDB\String
     */
    protected $twitter_username;

    /**
     * @MongoDB\String
     */
    protected $twitterID;


    public function __construct()
    {
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
