<?php

namespace Pasantias\EmpresasBundle\Controller;

use Pasantias\EmpresasBundle\Entity\Postulaciones;
use Pasantias\EmpresasBundle\Entity\Solicitudes;
use Pasantias\EmpresasBundle\Form\SolicitudesType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Solicitudes controller.
 *
 * @Route("/solicitud")
 */
class SolicitudesController extends Controller {

    /**
     * Lists all Solicitudes entities.
     *
     * @Route("/", name="solicitud")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        if ($this->get('security.context')->isGranted('ROLE_EMPRESA')) {
            $usuarioEmpresa = $this->get('security.context')->getToken()->getUser();
            $empresa = $usuarioEmpresa->getEmpresa();

            $solicitudes = $em->getRepository('EmpresasBundle:Solicitudes')->findByEmpresa($empresa);
        } else {
            $solicitudes = $em->getRepository('EmpresasBundle:Solicitudes')->findAll();
        }
        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
                $solicitudes, $this->get('request')->query->get('page', 1)/* page number */, 10/* limit per page */
        );
        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Solicitudes entity.
     *
     * @Route("/{id}/show", name="solicitud_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmpresasBundle:Solicitudes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Solicitudes entity.');
        }



        return array(
            'entity' => $entity,
        );
    }

    /**
     * Displays a form to create a new Solicitudes entity.
     *
     * @Route("/new", name="solicitud_new")
     * @Template()
     */
    public function newAction() {
        if ($this->get('security.context')->isGranted('ROLE_EMPRESA')) {
            $entity = new Solicitudes();
            $form = $this->createForm(new SolicitudesType(), $entity);

            return array(
                'entity' => $entity,
                'form' => $form->createView(),
            );
        } else {
            throw new AccessDeniedException('Solo un usuario con Perfil de Empresa puede crear la Solicitud');
        }
    }

    /**
     * Creates a new Solicitudes entity.
     *
     * @Route("/create", name="solicitud_create")
     * @Method("POST")
     * @Template("EmpresasBundle:Solicitudes:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Solicitudes();
        $form = $this->createForm(new SolicitudesType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $usuarioEmpresa = $this->get('security.context')->getToken()->getUser();
            $empresa = $usuarioEmpresa->getEmpresa();
            $entity->setEmpresa($empresa);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('solicitud'));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Solicitudes entity.
     *
     * @Route("/{id}/edit", name="solicitud_edit")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmpresasBundle:Solicitudes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Solicitudes entity.');
        }

        $editForm = $this->createForm(new SolicitudesType(), $entity);


        return array(
            'entity' => $entity,
            'form' => $editForm->createView(),
        );
    }

    /**
     * Edits an existing Solicitudes entity.
     *
     * @Route("/{id}/update", name="solicitud_update")
     * @Method("POST")
     * @Template("EmpresasBundle:Solicitudes:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmpresasBundle:Solicitudes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Solicitudes entity.');
        }


        $editForm = $this->createForm(new SolicitudesType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('solicitud_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Solicitudes entity.
     *
     * @Route("/{id}/delete", name="solicitud_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EmpresasBundle:Solicitudes')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Solicitudes entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('solicitud'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

    public function postularseAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmpresasBundle:Solicitudes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Solicitudes entity.');
        }

        if ($request->getMethod() == 'POST') {
            $usuarioPersona = $this->get('security.context')->getToken()->getUser();
            $persona = $usuarioPersona->getPersona();
            $postulaciones=$em->getRepository('EmpresasBundle:Postulaciones')->findByPersona($persona);
            if($postulaciones){
                $this->get('session')->getFlashBag()->add(
                    'error', 'Ya estas postulado a esta solicitud'
            );
            }else{
                
            
            $postulacion = new Postulaciones();
            $postulacion->setPersona($persona);
            $postulacion->setSolicitud($entity);
            $em->persist($postulacion);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'Te postulaste a esta solicitud'
            );
            
            }
        }

        return $this->render(
                        'EmpresasBundle:Solicitudes:postularse.html.twig', array('entity' => $entity)
        );
    }

}
