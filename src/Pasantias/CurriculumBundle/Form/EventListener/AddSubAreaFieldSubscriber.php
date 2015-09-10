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
use Symfony\Component\PropertyAccess\PropertyAccess;
use Doctrine\ORM\EntityRepository;
use Pasantias\CurriculumBundle\Entity\Area;

class AddSubAreaFieldSubscriber implements EventSubscriberInterface
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

    private function addSubAreaForm($form,$subArea, $area)
    {
        
        $form->add($this->factory->createNamed('subArea','entity',$subArea, array(
            'class'         => 'CurriculumBundle:SubArea',
            'auto_initialize'=> false,
            'empty_value'   => 'Seleccionar',
             'attr'          => array(
                'class' => 'subArea_selector',
            ),
            'query_builder' => function (EntityRepository $repository) use ($area) {
                $qb = $repository->createQueryBuilder('subArea')
                    ->innerJoin('subArea.area', 'area');
                if ($area instanceof Area) {
                    $qb->where('subArea.area = :area')
                    ->setParameter('area', $area->getId());
                } elseif (is_numeric($area)) {
                    $qb->where('area.id = :area')
                    ->setParameter('area', $area);
                } else {
                    $qb->where('area.nombre = :area')
                    ->setParameter('area', null);
                }

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
        
        $accessor = PropertyAccess::createPropertyAccessor();
        $subArea = $accessor->getValue($data, 'subArea');
        //$province = ($city) ? $city->getProvince() : null ;
        //$this->addCityForm($form, $city, $province);

        //$area = ($data->getSubArea()) ? $data->getSubArea()->getArea() : null ;
        $area = ($subArea) ? $subArea->getArea() : null ;
        
        $this->addSubAreaForm($form,$subArea, $area);
    }

    public function prehandleRequest(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }

         
//        $city = array_key_exists('city', $data) ? $data['city'] : null;
//        $this->addCityForm($form, $city, $province);
        
        $area = array_key_exists('area', $data) ? $data['area'] : null;
        $subArea = array_key_exists('subArea', $data) ? $data['subArea'] : null;
        $this->addSubAreaForm($form,$subArea, $area);
    }
}