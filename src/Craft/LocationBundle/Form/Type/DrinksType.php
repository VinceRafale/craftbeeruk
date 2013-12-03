<?php
/**
 * Author: rick
 * Date: 15/11/2013
 * Time: 11:54
 */

namespace Craft\LocationBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DrinksType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
            ->add('save', 'submit')
            ->add('remove', 'submit');
    }

    public function getName()
    {
        return 'location_drinks';
    }
}