<?php

namespace Pasantias\CurriculumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CampoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pasantias\CurriculumBundle\Entity\Campo'
        ));
    }

    public function getName()
    {
        return 'pasantias_curriculumbundle_campotype';
    }
}
