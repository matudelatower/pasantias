<?php

namespace Pasantias\UsuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of ChangePasswordType
 *
 * @author Matias Solis de la Torre <matias.delatorre89@gmail.com>
 */
class ChangePasswordType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('oldPassword', 'password', array(
            'label' => 'Contraseña Actual'
        ));
        $builder->add('newPassword', 'repeated', array(
            'type' => 'password',
            'invalid_message' => 'Las contraseñas deben coincidir',
            'required' => true,
            'first_options' => array('label' => 'Nueva Contraseña'),
            'second_options' => array('label' => 'Repetir Contraseña'),
        ));        
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Pasantias\UsuariosBundle\Form\Model\ChangePassword'
        ));
    }

    public function getName() {
        return 'change_passwd';
    }

}
