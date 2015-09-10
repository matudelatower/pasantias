<?php

namespace Pasantias\CurriculumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormacionAcademicaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('ingreso')
                ->add('egreso')
                ->add('estadoAvance','text',array(
                    'label' => 'Estado Avance',
                ))
                ->add('carrera', 'entity', array(
                    'required' => true,
                    'empty_value' => 'Seleccionar',
                    'class' => 'CurriculumBundle:Carrera',
                    'choice_label' => 'nombre',
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Pasantias\CurriculumBundle\Entity\FormacionAcademica'
        ));
    }

    public function getName() {
        return 'pasantias_curriculumbundle_formacionacademicatype';
    }

}
