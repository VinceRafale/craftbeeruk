<?php

namespace Craft\LocationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Craft\LocationBundle\Form\DataTransformer;

class LocationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('osmId', 'hidden')
            ->add('name', 'text')
            ->add(
                'outlet',
                'choice',
                [
                    'choices' => [
                        'pub' => 'pub',
                        'bar' => 'bar',
                        'off licence' => 'off licence',
                        'restaurant' => 'restaurant',
                        'cafe' => 'cafe'
                    ]
                ]
            )

            ->add('description', 'textarea')
            ->add(
                $builder->create('geolocation', 'hidden')
                    ->addModelTransformer(new DataTransformer\GeolocationToGeoJsonTransformer())
            )
            ->add(
                'beerOrigins',
                'choice',
                [
                    'multiple' => true,
                    'expanded' => true,
                    'choices' => [
                        'UK' => 'UK',
                        'Europe' => 'Europe',
                        'America' => 'America',
                        'Other' => 'Other'
                    ]
                ]
            )
            ->add('cask', new DrinkType())
            ->add('keg', new DrinkType())
            ->add('bottleSelection', new DrinkType())
            ->add('cider', new DrinkType())
            ->add('openingTimes', new OpeningTimesType())
            ->add('add', 'submit');

    }

    public function getName()
    {
        return 'location';
    }
}