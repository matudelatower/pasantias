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
use Pasantias\CurriculumBundle\Entity\Area;

class AddAreaFieldSubscriber implements EventSubscriberInterface
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
            FormEvents::PRE_SUBMIT     => 'preSubmit'
        );
    }

    private function addAreaForm($form, $area)
    {
        $form->add($this->factory->createNamed('area','entity', $area, array(
            'class'         => 'CurriculumBundle:Area',
            'auto_initialize'=> false,
            'empty_value'   => 'Seleccionar',
            'mapped'        => false,
            'attr'          => array(
                'class' => 'area_selector',
            ),
            'query_builder' => function (EntityRepository $repository) {
                $qb = $repository->createQueryBuilder('area');

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

        $area = ($data->getSubArea()) ? $data->getSubArea()->getArea() : null ;
        
        $this->addAreaForm($form, $area);
    }

    public function prehandleRequest(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }

        $area = array_key_exists('area', $data) ? $data['area'] : null;
        
        $this->addAreaForm($form, $area);
    }
}