<?php

namespace Pasantias\EmpresasBundle\Form;

use Pasantias\CurriculumBundle\Form\EventListener\AddAreaFieldSubscriber;
use Pasantias\CurriculumBundle\Form\EventListener\AddSubAreaFieldSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SolicitudesType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $factory = $builder->getFormFactory();
        $areaSubscriber = new AddAreaFieldSubscriber($factory);
        $builder->addEventSubscriber($areaSubscriber);
        $subAreaSubscriber = new AddSubAreaFieldSubscriber($factory);
        $builder->addEventSubscriber($subAreaSubscriber);
        $builder
                ->add('fechaDesde', 'date', array(
                    'widget' => 'single_text',
                    'label' => 'Desde',
                    'format' => 'dd-MM-yyyy',
                    'attr' => array('class' => 'date')
                ))
                ->add('fechaHasta', 'date', array(
                    'widget' => 'single_text',
                    'label' => 'Hasta',
                    'format' => 'dd-MM-yyyy',
                    'attr' => array('class' => 'date')
                ))
                ->add('perfilPostulante', 'textarea', array(
                    'label_attr' => array('for' => 'textArea'),
                    'attr' => array("class" => "form-control",
                        "rows" => "3"),
                ))
                ->add('conocRequeridos', 'textarea', array(
                    'label' => 'Conocimientos Requeridos',
                    'label_attr' => array('for' => 'textArea'),
                    'attr' => array("class" => "form-control",
                        "rows" => "3"),
                ))
                ->add('nivelCarreraCandidato', 'textarea', array(
                    'label_attr' => array('for' => 'textArea'),
                    'attr' => array("class" => "form-control",
                        "rows" => "3"),
                ))
                ->add('solicitudAtendida', 'checkbox', array(
                    'required' => false,
                ))
                ->add('tiposTrabajo', 'entity', array(
                    'class' => 'EmpresasBundle:TiposTrabajo',                    
                    'empty_value' => 'Seleccionar',
                ))
                //->add('subArea')
                ->add('empresa')
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Pasantias\EmpresasBundle\Entity\Solicitudes'
        ));
    }

    public function getName() {
        return 'pasantias_empresasbundle_solicitudestype';
    }

}
