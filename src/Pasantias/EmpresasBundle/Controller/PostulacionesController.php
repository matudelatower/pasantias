<?php

namespace Pasantias\EmpresasBundle\Controller;

use Pasantias\EmpresasBundle\Entity\PostulacionesNuevas;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class PostulacionesController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        if ($this->get('security.context')->isGranted('ROLE_EMPRESA')) {
            $usuarioEmpresa = $this->get('security.context')->getToken()->getUser();
            $empresa = $usuarioEmpresa->getEmpresa();

            $solicitudes = $em->getRepository('EmpresasBundle:Solicitudes')->findByEmpresa($empresa);

            $postulaciones = $em->getRepository('EmpresasBundle:Postulaciones')->findBySolicitud($solicitudes);
            foreach ($postulaciones as $postulacion) {
                $postulacionNueva = new PostulacionesNuevas();
                $postulacionNueva->setPostulaciones($postulacion);
                $postulacionNueva->setVisto(TRUE);
                $postulacionNueva->setEmpresa($empresa);
                $em->persist($postulacionNueva);
            }
            $em->flush();

            $paginator = $this->get('knp_paginator');
            $entities = $paginator->paginate(
                    $postulaciones, $this->get('request')->query->get('page', 1)/* page number */, 10/* limit per page */
            );
//            return array(
//                'entities' => $entities,
//            );
            return $this->render('EmpresasBundle:Postulaciones:index.html.twig', array(
                        'entities' => $entities,
            ));
        }else{
            throw new AccessDeniedException('No tiene Permisos para ver las postulaciones');
        }
    }

    public function showAction() {
        
    }

}
