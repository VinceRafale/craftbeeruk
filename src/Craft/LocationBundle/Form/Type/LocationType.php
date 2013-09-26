<?php

namespace Craft\LocationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Craft\LocationBundle\Form\DataTransformer;

class LocationType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $form = $builder->add('osmId','hidden')
                ->add('name','text')
                ->add('description','textarea')
                ->add('outlet','choice',[
                    'choices' => ['pub' => 'pub',
                        'bar' => 'bar',
                        'off licence' => 'off licence',
                        'restaurant' => 'restaurant',
                        'cafe' => 'cafe']
                    ])
                ->add($builder->create('geolocation','text')
                        ->addModelTransformer(new DataTransformer\GeolocationToGeoJsonTransformer()))
                ->add('kegLines')
                ->add('caskLines')
                ->add('real_cider')
                ->add('beerOrigins', 'choice', ['multiple' => true,'expanded' => true,'choices' => ['UK' => 'UK',
                    'Europe'=>'Europe', 
                    'America'=>'America', 
                    'Other'=>'Other']])
                ->add('add','submit');
    }
    
    public function getName() {
        return 'location';
    }
}