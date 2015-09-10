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
use Pasantias\UbicacionBundle\Entity\Provincias;

class AddLocalidadFieldSubscriber implements EventSubscriberInterface
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
            FormEvents::PRE_SUBMIT => 'preHandleRequest'
        );
    }

    private function addLocalidadForm($form, $localidad, $provincia)
    {

        $form->add(
            $this->factory->createNamed(
                'localidad',
                'entity',
                $localidad,
                array(
                    'class' => 'UbicacionBundle:Localidades',
                    'auto_initialize' => false,
                    'empty_value' => 'Seleccionar',
                    'attr' => array(
                        'class' => 'city_selector',
                    ),
                    'query_builder' => function (EntityRepository $repository) use ($provincia) {
                        $qb = $repository->createQueryBuilder('localidad')
                            ->innerJoin('localidad.provincias', 'provincias');
                        if ($provincia instanceof Provincias) {
                            $qb->where('localidad.provincias = :provincias')
                                ->setParameter('provincias', $provincia->getId());
                        } elseif (is_numeric($provincia)) {
                            $qb->where('provincias.id = :provincias')
                                ->setParameter('provincias', $provincia);
                        } else {
                            $qb->where('provincias.nombreProvincia = :provincias')
                                ->setParameter('provincias', null);
                        }

                        return $qb;
                    }
                )
            )
        );
    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }

        $accessor = PropertyAccess::createPropertyAccessor();
        $localidad = $accessor->getValue($data, 'localidad');
        //$province = ($city) ? $city->getProvince() : null ;
        //$this->addCityForm($form, $city, $province);

        //$provincia = ($data->getLocalidad()) ? $data->getLocalidad()->getProvincia() : null ;
        $provincia = ($localidad) ? $localidad->getProvincia() : null;

        $this->addLocalidadForm($form, $localidad, $provincia);
    }

    public function preHandleRequest(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }


//        $city = array_key_exists('city', $data) ? $data['city'] : null;
//        $this->addCityForm($form, $city, $province);

        $provincia = array_key_exists('provincia', $data) ? $data['provincia'] : null;
        $localidad = array_key_exists('localidad', $data) ? $data['localidad'] : null;
        $this->addLocalidadForm($form, $localidad, $provincia);
    }
}