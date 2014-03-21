<?php

namespace Pasantias\CurriculumBundle\Form;

use Pasantias\CurriculumBundle\Entity\Conocimientos;
use Pasantias\CurriculumBundle\Entity\Domicilio;
use Pasantias\CurriculumBundle\Entity\FormacionAcademica;
use Pasantias\CurriculumBundle\Entity\FormacionAcademicaSecundaria;
use Pasantias\CurriculumBundle\Form\ConocimientosType;
use Pasantias\CurriculumBundle\Form\DomicilioType;
use Pasantias\CurriculumBundle\Form\FormacionAcademicaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre')
                ->add('apellido')
                ->add('sexo', 'choice', array(
                    'choices' => array('M' => 'Masculino', 'F' => 'Femenino'),
                ))
                ->add('dni', 'text', array('label' => 'DNI'))
                ->add('cuit', 'text', array('label' => 'CUIT'))
//                ->add('fechaNacimiento', 'birthday', array(
//                    'format' => 'dd-MM-yyyy',
//                ))
                ->add('fechaNacimiento', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'label' => 'Fecha Nacimiento',
                    'attr' => array('class' => 'date')
                ))
                ->add('file', 'file', array(
                    'label' => 'Foto',
                    'required'=>false,
                    'attr'=>array('class'=>'btn btn-primary btn-sm')
                    ))
                ->add('path')
                ->add('telefono')
                ->add('domicilio', 'collection', array(
                    'type' => new DomicilioType(),
                    'label' => 'Direcciones',
                    'by_reference' => false,
                    'prototype_data' => new Domicilio(),
                    'allow_delete' => true,
                    'allow_add' => true,
                    'attr' => array(
                        'class' => 'row addresses'
            )))
                ->add('formacionAcademicaSecundaria', 'collection', array(
                    'type' => new FormacionAcademicaSecundariaType(),
                    'label' => 'Formacion Academica',
                    'by_reference' => false,
                    'prototype_data' => new FormacionAcademicaSecundaria(),
                    'allow_delete' => true,
                    'allow_add' => true,
                    'attr' => array(
                        'class' => 'row formacionAcademicaSecundaria'
            )))
                ->add('formacionAcademica', 'collection', array(
                    'type' => new FormacionAcademicaType(),
                    'label' => 'Formacion Academica',
                    'by_reference' => false,
                    'prototype_data' => new FormacionAcademica(),
                    'allow_delete' => true,
                    'allow_add' => true,
                    'attr' => array(
                        'class' => 'row formacionAcademica'
            )))
                ->add('conocimientos', 'collection', array(
                    'type' => new ConocimientosType(),
                    'label' => 'Direcciones',
                    'by_reference' => false,
                    'prototype_data' => new Conocimientos(),
                    'allow_delete' => true,
                    'allow_add' => true,
                    'attr' => array(
                        'class' => 'row conocimientos'
            )))
                ->add('antecedente_laboral', 'collection', array('type' => new AntecedenteLaboralType,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                ))
        //->add('formacion_academica', new FormacionAcademicaType())
        //->add('conocimientos', new ConocimientosType())
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Pasantias\CurriculumBundle\Entity\Persona'
        ));
    }

    public function getName() {
        return 'pasantias_curriculumbundle_personatype';
    }

}
