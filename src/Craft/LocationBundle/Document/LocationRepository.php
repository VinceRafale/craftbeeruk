<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 31/10/2013
 * Time: 10:21
 */

namespace Craft\LocationBundle\Document;

use Doctrine\ODM\MongoDB\DocumentRepository;

class LocationRepository extends DocumentRepository
{

    public function findLocation($field, $value)
    {

        return $this->findOneBy([$field => $value]);
    }

    public function findLocationBySlug($slug)
    {
        return $this->findLocation('slug', $slug);
    }

} 