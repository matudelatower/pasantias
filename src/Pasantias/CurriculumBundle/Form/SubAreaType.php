<?php

namespace Pasantias\CurriculumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SubAreaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('area')
                ->add('area', 'entity', array(
                    'class' => 'CurriculumBundle:Area',
                    'property' => 'nombre',
                    'empty_value' => 'Seleccionar',
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pasantias\CurriculumBundle\Entity\SubArea'
        ));
    }

    public function getName()
    {
        return 'pasantias_curriculumbundle_subareatype';
    }
}
