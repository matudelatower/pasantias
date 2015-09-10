<?php

namespace Pasantias\EmpresasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Pasantias\CurriculumBundle\Entity\Domicilio;



class EmpresasType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombreEmpresa')
                ->add('personaContacto')
                ->add('telContacto')
                ->add('mailContacto')
                ->add('paginaWeb')
//                ->add('domicilio')
//                ->add('domicilio', 'collection', array('type' => new DomicilioType(),
//                    'allow_add' => true,
//                    'allow_delete' => true,
//                    'by_reference' => false,
//                ))
                ->add('domicilio', 'collection', array(
                'type'           => new \Pasantias\CurriculumBundle\Form\DomicilioType(),
                'label'          => 'Domicilios',
                'by_reference'   => false,
                'prototype_data' => new Domicilio(),
                'allow_delete'   => true,
                'allow_add'      => true,
                'attr'           => array(
                    'class' => 'row domicilios'
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Pasantias\EmpresasBundle\Entity\Empresas'
        ));
    }

    public function getName() {
        return 'pasantias_empresasbundle_empresastype';
    }

}
