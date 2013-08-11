<?php

namespace Craft\LocationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class LocationType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $form = $builder->add('osmId','hidden')
                ->add('name','text')
                ->add('outlet','choice',[
                    'choices' => ['pub','bar','off licence','restaurant','cafe']
                    ])
                ->add('geolocation','text')
                ->add('kegLines')
                ->add('caskLines')
                ->add('real_cider')
                ->add('beerOrigins', 'choice', ['multiple' => true,'expanded' => true,'choices' => ['UK', 'Europe', 'America', 'Other']])
                ->add('add','submit');
    }
    
    public function getName() {
        return 'location';
    }
}