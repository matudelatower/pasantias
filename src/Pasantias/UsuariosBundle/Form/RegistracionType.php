<?php

namespace Pasantias\UsuariosBundle\Form;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegistracionType
 *
 * @author root
 */
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

//use Symfony\Component\OptionsResolver\OptionsResolverInterface;
//use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistracionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        //$builder->add('usuario', new UsuariosType());
        $builder
                ->add('usuario', new UsuariosType())
//                ->add('password', 'repeated', array(
//                    'type' => 'password',
//                    'first_name' => 'Contrasena',
//                    'second_name' => 'Repetir_Contrasena',
//                    'invalid_message' => 'Las dos contraseñas deben coincidir',
//                    
//                ))
//                ->add('mail')
//                ->add('perfil', 'entity', array(
//                    'required' => true,
//                    'empty_value' => 'Seleccionar',
//                    'class' => 'UsuariosBundle:Perfil',
//                    'property' => 'nombrePerfil',
//                ))

        ;
    }

//    public function setDefaultOptions(OptionsResolverInterface $resolver) {
//        $resolver->setDefaults(array(
//            'data_class' => 'Pasantias\UsuariosBundle\Entity\Usuarios'
//        ));
//    }

    public function getName() {
        return 'registracion';
    }

}


