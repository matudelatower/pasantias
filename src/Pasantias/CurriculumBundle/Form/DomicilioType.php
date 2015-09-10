<?php

namespace Pasantias\CurriculumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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


        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Pasantias\CurriculumBundle\Entity\Domicilio'
        ));
    }

    public function getName() {
        return 'pasantias_curriculumbundle_domiciliotype';
    }

}
