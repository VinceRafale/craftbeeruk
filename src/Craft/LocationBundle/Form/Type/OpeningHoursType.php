<?php
/**
 * Author: rick
 * Date: 12/11/2013
 * Time: 11:56
 */

namespace Craft\LocationBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OpeningHoursType extends AbstractType
{

    public function buildForm(FormBuilderInterface $formBuilder, array $options)
    {
        $formBuilder->add('closed')
            ->add(
                'opens',
                'time',
                [
                    'widget' => 'single_text',
                    'input' => 'string'
                ]
            )
            ->add(
                'closes',
                'time',
                [
                    'widget' => 'single_text',
                    'input' => 'string'
                ]
            );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'Craft\LocationBundle\Document\OpeningHours',
                'attr' => ['class' => 'openinghours']
            ]
        );
    }

    public function getName()
    {
        return 'drink';
    }

} 