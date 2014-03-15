<?php

namespace Pasantias\CurriculumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CarreraType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre')
                ->add('plan')
                ->add('duracion')
                ->add('cantidadMaterias')
//            ->add('tipo')
                ->add('tipo', 'entity', array(
                    'required' => true,
                    'empty_value' => 'Seleccionar',
                    'class' => 'CurriculumBundle:TipoCarrera',
                    'property' => 'nombre',
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Pasantias\CurriculumBundle\Entity\Carrera'
        ));
    }

    public function getName() {
        return 'pasantias_curriculumbundle_carreratype';
    }

}
