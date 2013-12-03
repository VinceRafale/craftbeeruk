<?php
/**
 * Author: rick
 * Date: 15/11/2013
 * Time: 11:54
 */

namespace Craft\LocationBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class FoodType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('available')
            ->add('description')
            ->add('menu')
            ->add('save', 'submit')
            ->add('remove', 'submit');
    }

    public function getName()
    {
        return 'location_food';
    }
}