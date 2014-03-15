<?php

namespace Pasantias\CurriculumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Pasantias\CurriculumBundle\Form\EventListener\AddSubAreaFieldSubscriber;
use Pasantias\CurriculumBundle\Form\EventListener\AddAreaFieldSubscriber;

class ConocimientosType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $factory = $builder->getFormFactory();
        $areaSubscriber = new AddAreaFieldSubscriber($factory);
        $builder->addEventSubscriber($areaSubscriber);
        $subAreaSubscriber = new AddSubAreaFieldSubscriber($factory);
        $builder->addEventSubscriber($subAreaSubscriber);

        $builder
//            ->add('persona')
                ->add('descripcion')
//                ->add('area', 'entity', array(
//                    'required' => false,
//                    'empty_value' => 'Seleccionar',
//                    'class' => 'CurriculumBundle:Area',
//                    'property' => 'nombre',
//                ))
//                ->add('subArea')
                ->add('campo')
                ->add('nivel')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Pasantias\CurriculumBundle\Entity\Conocimientos'
        ));
    }

    public function getName() {
        return 'pasantias_curriculumbundle_conocimientostype';
    }

}
