<?php

namespace Pasantias\UsuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuariosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('usuario')
            ->add('password','hidden')
            ->add('activo','checkbox',array(
                'required'=>false,
            ))
//            ->add('mail')
//            ->add('salt')
//            ->add('perfil')
//                ->add('password', 'repeated', array(
//                    'type' => 'password',
//                    'first_name' => 'Contrasena',
//                    'second_name' => 'Repetir_Contrasena',
//                    'invalid_message' => 'Las dos contraseñas deben coincidir',
//                    
//                ))
                ->add('mail','email')
                ->add('perfil', 'entity', array(
                    'required' => true,
                    'empty_value' => 'Seleccionar',
                    'class' => 'UsuariosBundle:Perfil',
                    'property' => 'nombrePerfil',
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pasantias\UsuariosBundle\Entity\Usuarios'
        ));
    }

    public function getName()
    {
        return 'pasantias_usuariosbundle_usuariostype';
    }
}
