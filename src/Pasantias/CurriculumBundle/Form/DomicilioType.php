<?php

namespace Pasantias\CurriculumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Pasantias\CurriculumBundle\Form\EventListener\AddLocalidadFieldSubscriber;
use Pasantias\CurriculumBundle\Form\EventListener\AddProvinciaFieldSubscriber;

class DomicilioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        
        $factory = $builder->getFormFactory();
        $provinciaSubscriber = new AddProvinciaFieldSubscriber($factory);
        $builder->addEventSubscriber($provinciaSubscriber);
        $localidadSubscriber = new AddLocalidadFieldSubscriber($factory);
        $builder->addEventSubscriber($localidadSubscriber);

        $builder
                ->add('calle')
                ->add('numero')
                ->add('depto', 'text', array(
                    'required' => false,
                ))
                ->add('piso', 'text', array(
                    'required' => false,
                ))

//                ->add('localidad', 'entity', array(
//                    'required' => true,
//                    'empty_value' => 'Seleccionar',
//                    'class' => 'UbicacionBundle:Localidades',
//                    'property' => 'Localidades',
//                ))
//                ->add('provincias', 'entity', array(
//                    'required' => false,
//                    'empty_value' => 'Seleccionar',
//                    'class' => 'UbicacionBundle:Provincias',
//                    'property' => 'nombreProvincia',
//                ))
//                ->add('localidad', 'choice', array(
//                    'choices' => Array(),
//                    'empty_value' => 'Seleccionar',))
//                

        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Pasantias\CurriculumBundle\Entity\Domicilio'
        ));
    }

    public function getName() {
        return 'pasantias_curriculumbundle_domiciliotype';
    }

}
