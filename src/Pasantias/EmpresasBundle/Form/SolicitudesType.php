<?php

namespace Pasantias\EmpresasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SolicitudesType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
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
                ->add('perfilPostulante')
                ->add('conocRequeridos','textarea',array(
                    'label'=>'Conocimientos Requeridos'
                ))
                ->add('nivelCarreraCandidato')
                ->add('solicitudAtendida','checkbox', array(
                    'required' => false,
                ))
                ->add('tiposTrabajo')
                ->add('subArea')
                ->add('empresa')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Pasantias\EmpresasBundle\Entity\Solicitudes'
        ));
    }

    public function getName() {
        return 'pasantias_empresasbundle_solicitudestype';
    }

}
