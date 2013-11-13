<?php

namespace Craft\LocationBundle\Security\Authorization\Voter;

use Craft\LocationBundle\Document\Location;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class LocationVoter implements VoterInterface
{

    public function vote(TokenInterface $token, Location $object, array $attributes)
    {
        if (in_array('ROLE_LOCATION_MODERATOR', $token->getRoles())) {
            return VoterInterface::ACCESS_GRANTED;
        }


        return VoterInterface::ACCESS_ABSTAIN;
    }


    /**
     * Checks if the voter supports the given attribute.
     *
     * @param string $attribute An attribute
     *
     * @return Boolean true if this Voter supports the attribute, false otherwise
     */
    public function supportsAttribute($attribute)
    {
        return true;
    }

    /**
     * Checks if the voter supports the given class.
     *
     * @param string $class A class name
     *
     * @return Boolean true if this Voter can process the class
     */
    public function supportsClass($class)
    {
        return $class === 'Craft\LocationBundle\Document\Location';
    }
}

