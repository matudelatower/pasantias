<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pasantias\CurriculumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Pasantias\CurriculumBundle\Form\PersonaType;
use Pasantias\CurriculumBundle\Entity\Persona;
//use Pasantias\CurriculumBundle\Form\FormacionAcademicaType;
//use Pasantias\CurriculumBundle\Form\ConocimientosType;
//use Pasantias\CurriculumBundle\Entity\Conocimientos;
//use Pasantias\CurriculumBundle\Entity\FormacionAcademica;

/**
 * Description of CurriculumPersonasType
 *
 * @author matias
 */
class CurriculumPersonasType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
//                ->add('nombreEmpresa')
//                ->add('personaContacto')
//                ->add('telContacto')
//                ->add('mailContacto')
//                ->add('paginaWeb')
//                ->add('domicilio', 'collection', array(
//                    'type' => new DomicilioType(),
//                    'label' => 'Domicilio',
//                    'by_reference' => false,
//                    'prototype_data' => new Domicilio(),
//                    'allow_delete' => true,
//                    'allow_add' => true,
//                    'attr' => array(
//                        'class' => 'row domicilios'
//                    )
//                ))
//                >add('persona')
                ->add('persona', new PersonaType())
//                ->add('persona', new PersonaType(), array(
//                    'attr' => array(
//                        'class' => 'persona'
//                    )
//                ->add('persona', 'collection', array(
//                    'type' => new PersonaType(),
//                    'label' => 'Domicilio',
//                    'by_reference' => false,
//                    'prototype_data' => new Persona(),
//                    'allow_delete' => false,
//                    'allow_add' => false,
//                    'attr' => array(
//                        'class' => 'row persona'
//                    )
//                ))
                
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Pasantias\CurriculumBundle\Entity\Curriculum',

        ));
    }

    public function getName() {
        return 'curriculum_personas';
    }

}


