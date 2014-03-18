<?php

namespace Pasantias\CurriculumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AntecedenteLaboralType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('empresa')
                ->add('fechaDesde', 'date', array(
                    'widget' => 'single_text',
                    'label' => 'Desde',
                    'format' => 'dd-MM-yyyy',
                    'attr' => array('class' => 'date')
                ))
                ->add('fechaHasta', 'text', array(
                    'attr' => array('class' => 'date')
                ))
                ->add('descripcion', 'textarea', array(
                    'label_attr' => array('for' => 'textArea'),
                    'attr' => array("class" => "form-control",
                        "rows" => "3"),
                ))
                ->add('nombreContacto', 'text', array(
                    'label' => 'Nombre Contacto',
                    'required' => false,
                ))
                ->add('telContacto', 'text', array(
                    'label' => 'Tel Contacto',
                    'required' => false,
                ))
//            ->add('persona')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Pasantias\CurriculumBundle\Entity\AntecedenteLaboral'
        ));
    }

    public function getName() {
        return 'pasantias_curriculumbundle_antecedentelaboraltype';
    }

}
