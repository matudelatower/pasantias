<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pasantias\CurriculumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
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

                ->add('persona', new PersonaType())

                
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Pasantias\CurriculumBundle\Entity\Curriculum',

        ));
    }

    public function getName() {
        return 'curriculum_personas';
    }

}


