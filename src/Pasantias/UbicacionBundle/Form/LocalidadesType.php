<?php

namespace Pasantias\UbicacionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LocalidadesType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombreLocalidad')
                ->add('provincias', 'entity', array(
                    'class' => 'UbicacionBundle:Provincias',
                    'property' => 'nombreProvincia',
                    'empty_value' => 'Seleccionar',
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Pasantias\UbicacionBundle\Entity\Localidades'
        ));
    }

    public function getName() {
        return 'pasantias_ubicacionbundle_localidadestype';
    }

}
