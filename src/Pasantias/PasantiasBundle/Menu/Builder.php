<?php

// src/Pasantias/PasantiasBundle/Menu/Builder.php

namespace Pasantias\PasantiasBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware {

    public function mainMenu(FactoryInterface $factory, array $options) {

        $menu = $factory->createItem('My Menu');

//        print_r($options);
        $menu->addChild('Inicio', array('route' => 'pasantias_homepage'));

        if ($options['usuario'][0] == 'ROLE_ALUMNO') {

            $menu->addChild('CV', array('route' => 'curriculum_homepage'));
        }
        if ($options['usuario'][0] == 'ROLE_ADMIN') {
            $menu->addChild('Ubicacion');               
            $menu['Ubicacion']->setUri('#');                    
            $menu['Ubicacion']->addChild('Provincias', array('route' => 'pasantias_provincias'));                    
            $menu['Ubicacion']->addChild('Localidades', array('route' => 'pasantias_localidades'));
            
            $menu->addChild('Carreras');
            $menu['Carreras']->setUri('#');
            $menu['Carreras']->addChild('Carrera', array('route' => 'carrera_homepage'));
            $menu['Carreras']->addChild('Tipo Carrera', array('route' => 'tipo_carrera_homepage'));
            $menu->addChild('Areas');
            $menu['Areas']->setUri('#');
            $menu['Areas']->addChild('Area', array('route' => 'area'));
            $menu['Areas']->addChild('Sub Area', array('route' => 'sub_area'));
            $menu->addChild('Campo', array('route' => 'campo'));
            $menu->addChild('Nivel', array('route' => 'nivel'));
//            $menu->addChild('Empresas');
//            $menu['Empresas']->setUri('#');
//            $menu['Empresas']->addChild('Empresa', array('route' => 'empresas'));
//            $menu['Empresas']->addChild('Solicitudes', array('route' => 'solicitud'));
//            $menu['Empresas']->addChild('Tipo Trabajo', array('route' => 'tipo_trabajo'));
            // ... add more children
        }

        if ($options['usuario'][0] == 'ROLE_EMPRESA' || $options['usuario'][0] == 'ROLE_ADMIN') {
            $menu->addChild('Empresas');
            $menu['Empresas']->setUri('#');
            $menu['Empresas']->addChild('Empresa', array('route' => 'empresas'));
            $menu['Empresas']->addChild('Solicitudes', array('route' => 'solicitud'));
        }
        if ($options['usuario'][0] == 'ROLE_ADMIN') {
            $menu['Empresas']->addChild('Tipo Trabajo', array('route' => 'tipo_trabajo'));
        }
        $menu->setChildrenAttributes(array('class' => 'nav navbar-nav'));
        return $menu;
    }

}
