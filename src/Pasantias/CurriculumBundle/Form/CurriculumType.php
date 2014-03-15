<?php

namespace Pasantias\CurriculumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CurriculumType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
//            ->add('fecha')
                ->add('persona', new PersonaType())
//                ->add('persona', new PersonaType(), array(
//                    'attr' => array(
//                        'class' => 'persona'
//                    )
//                ))

//        $builder->add('persona', 'collection', array('type' => new PersonaType(),
//            'allow_add' => true,
//        'by_reference' => false));
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Pasantias\CurriculumBundle\Entity\Curriculum'
        ));
    }

    public function getName() {
        return 'pasantias_curriculumbundle_curriculumtype';
    }

}
