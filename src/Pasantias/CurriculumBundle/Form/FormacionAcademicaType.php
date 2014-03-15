<?php

namespace Pasantias\CurriculumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FormacionAcademicaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('ingreso')
                ->add('egreso')
                ->add('estadoAvance','text',array(
                    'label' => 'Estado Avance',
                ))
//            ->add('carrera')
                ->add('carrera', 'entity', array(
                    'required' => true,
                    'empty_value' => 'Seleccionar',
                    'class' => 'CurriculumBundle:Carrera',
                    'property' => 'nombre',
                ))
//            ->add('persona')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Pasantias\CurriculumBundle\Entity\FormacionAcademica'
        ));
    }

    public function getName() {
        return 'pasantias_curriculumbundle_formacionacademicatype';
    }

}
