<?php

namespace Craft\LocationBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\EmbeddedDocument
 */
class User
{

    /** @MongoDB\ReferenceOne(targetDocument="Craft\UserBundle\Document\User") */
    protected $user;

    /** @MongoDB\String */
    protected $ip;

    /** @MongoDB\Date */
    protected $timestamp;


    public function __construct(\Craft\UserBundle\Document\User $user, $ip)
    {
        $this->setIp($ip);
        $this->setUser($user);
        $this->setTimestamp(new \DateTime());
    }

    /**
     * Set user
     *
     * @param Craft\UserBundle\Document\User $user
     * @return User
     */
    public function setUser(\Craft\UserBundle\Document\User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return Craft\UserBundle\Document\User $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return User
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * Get ip
     *
     * @return string $ip
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set timestamp
     *
     * @param date $timestamp
     * @return User
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    /**
     * Get timestamp
     *
     * @return date $timestamp
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }
}
