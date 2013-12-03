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

class OpeningTimesType extends AbstractType
{

    public function buildForm(FormBuilderInterface $formBuilder, array $options)
    {
        foreach ([
                     'mon' => 'Monday',
                     'tue' => 'Tuesday',
                     'wed' => 'Wednesday',
                     'thu' => 'Thursday',
                     'fri' => 'Friday',
                     'sat' => 'Saturday',
                     'sun' => 'Sunday'
                 ] as $name => $label) {
            $formBuilder->add(
                $name,
                new OpeningHoursType(),
                [
                    'label' => $label
                ]
            );
        }

        $formBuilder->add('save', 'submit')
            ->add('remove', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'Craft\LocationBundle\Document\OpeningTimes'
            ]
        );
    }

    public function getName()
    {
        return 'drink';
    }

} 