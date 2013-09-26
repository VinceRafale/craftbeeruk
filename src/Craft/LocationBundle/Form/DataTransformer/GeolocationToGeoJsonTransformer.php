<?php
namespace Craft\LocationBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Craft\LocationBundle\Document;

/**
 * Description of GeolocationToGeoJsonTransformer
 *
 * @author rick
 */
class GeolocationToGeoJsonTransformer implements DataTransformerInterface
{
    
    
    public function transform($geolocation)
    {
        if(null === $geolocation) {
            return "";
        }
        
        return (string)$geolocation;
    }
    
    public function reverseTransform($location)
    {
        return Document\Geolocation::fromGeoJson($location);
       
    }
}

?>
