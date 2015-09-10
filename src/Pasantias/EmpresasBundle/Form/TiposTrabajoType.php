<?php

namespace Pasantias\EmpresasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TiposTrabajoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pasantias\EmpresasBundle\Entity\TiposTrabajo'
        ));
    }

    public function getName()
    {
        return 'pasantias_empresasbundle_tipostrabajotype';
    }
}
