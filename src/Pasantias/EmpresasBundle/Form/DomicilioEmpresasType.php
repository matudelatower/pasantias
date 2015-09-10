<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pasantias\EmpresasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Pasantias\CurriculumBundle\Entity\Domicilio;
use Pasantias\CurriculumBundle\Form\DomicilioType;

/**
 * Description of DomicilioEmpresasType
 *
 * @author matias
 */
class DomicilioEmpresasType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombreEmpresa')
                ->add('personaContacto')
                ->add('telContacto')
                ->add('mailContacto')
                ->add('paginaWeb')
                ->add('domicilio', 'collection', array(
                    'type' => new DomicilioType(),
                    'label' => 'Domicilio',
                    'by_reference' => false,
                    'prototype_data' => new Domicilio(),
                    'allow_delete' => true,
                    'allow_add' => true,
                    'attr' => array(
                        'class' => 'row domicilios'
                    )
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Pasantias\EmpresasBundle\Entity\Empresas',

        ));
    }

    public function getName() {
        return 'empresas_domicilio';
    }

}

