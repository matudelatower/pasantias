<?php

namespace Pasantias\EmpresasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Pasantias\EmpresasBundle\Entity\TiposTrabajo;
use Pasantias\EmpresasBundle\Form\TiposTrabajoType;

/**
 * TiposTrabajo controller.
 *
 * @Route("/tipo_trabajo")
 */
class TiposTrabajoController extends Controller {

    /**
     * Lists all TiposTrabajo entities.
     *
     * @Route("/", name="tipo_trabajo")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $tiposTrabajo = $em->getRepository('EmpresasBundle:TiposTrabajo')->findAll();
        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
                $tiposTrabajo, $this->get('request')->query->get('page', 1)/* page number */, 10/* limit per page */
        );

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a TiposTrabajo entity.
     *
     * @Route("/{id}/show", name="tipo_trabajo_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmpresasBundle:TiposTrabajo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TiposTrabajo entity.');
        }



        return array(
            'entity' => $entity,
        );
    }

    /**
     * Displays a form to create a new TiposTrabajo entity.
     *
     * @Route("/new", name="tipo_trabajo_new")
     * @Template()
     */
    public function newAction() {
        $entity = new TiposTrabajo();
        $form = $this->createForm(new TiposTrabajoType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new TiposTrabajo entity.
     *
     * @Route("/create", name="tipo_trabajo_create")
     * @Method("POST")
     * @Template("EmpresasBundle:TiposTrabajo:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new TiposTrabajo();
        $form = $this->createForm(new TiposTrabajoType(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add(
                    'success', 'Tipo de trabajo creado correctamente.'
            );

            return $this->redirect($this->generateUrl('tipo_trabajo'));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TiposTrabajo entity.
     *
     * @Route("/{id}/edit", name="tipo_trabajo_edit")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmpresasBundle:TiposTrabajo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TiposTrabajo entity.');
        }

        $editForm = $this->createForm(new TiposTrabajoType(), $entity);


        return array(
            'entity' => $entity,
            'form' => $editForm->createView(),
        );
    }

    /**
     * Edits an existing TiposTrabajo entity.
     *
     * @Route("/{id}/update", name="tipo_trabajo_update")
     * @Method("POST")
     * @Template("EmpresasBundle:TiposTrabajo:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmpresasBundle:TiposTrabajo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TiposTrabajo entity.');
        }


        $editForm = $this->createForm(new TiposTrabajoType(), $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'success', 'Tipo de trabajo modificado correctamente.'
            );

            return $this->redirect($this->generateUrl('tipo_trabajo'));
        }

        return array(
            'entity' => $entity,
            'form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a TiposTrabajo entity.
     *
     * @Route("/{id}/delete", name="tipo_trabajo_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EmpresasBundle:TiposTrabajo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TiposTrabajo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tipo_trabajo'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
