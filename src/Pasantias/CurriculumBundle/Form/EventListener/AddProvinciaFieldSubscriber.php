<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Pasantias\CurriculumBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityRepository;
//use SMTC\MainBundle\Form\Model\User;
use Pasantias\UbicacionBundle\Entity\Provincias;

class AddProvinciaFieldSubscriber implements EventSubscriberInterface
{
    private $factory;

    public function __construct(FormFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT     => 'preHandleRequest'
        );
    }

    private function addProvinciaForm($form, $provincia)
    {
        $form->add($this->factory->createNamed('provincia','entity', $provincia, array(
            'class'         => 'UbicacionBundle:Provincias',
            'auto_initialize'=> false,
            'empty_value'   => 'Seleccionar',
            'mapped'        => false,
            'attr'          => array(
                'class' => 'province_selector',
            ),
            'query_builder' => function (EntityRepository $repository) {
                $qb = $repository->createQueryBuilder('provincia');

                return $qb;
            }
        )));
    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }

        $provincia = ($data->getLocalidad()) ? $data->getLocalidad()->getProvincia() : null ;
        
        $this->addProvinciaForm($form, $provincia);
    }

    public function preHandleRequest(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }

        $provincia = array_key_exists('provincia', $data) ? $data['provincia'] : null;
        
        $this->addProvinciaForm($form, $provincia);
    }
}