<?php

namespace Pasantias\UbicacionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pasantias\UbicacionBundle\Entity\Provincias;
use Pasantias\UbicacionBundle\Form\ProvinciasType;

/**
 * Provincias controller.
 *
 */
class ProvinciasController extends Controller {

    /**
     * Lists all Provincias entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $provincias = $em->getRepository('UbicacionBundle:Provincias')->findAll();

        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
                $provincias, $this->get('request')->query->get('page', 1)/* page number */, 10/* limit per page */
        );
        
        return $this->render('UbicacionBundle:Provincias:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Provincias entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UbicacionBundle:Provincias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Provincias entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UbicacionBundle:Provincias:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to create a new Provincias entity.
     *
     */
    public function newAction() {
        $entity = new Provincias();
        $form = $this->createForm(new ProvinciasType(), $entity);

        return $this->render('UbicacionBundle:Provincias:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new Provincias entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Provincias();
        $form = $this->createForm(new ProvinciasType(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pasantias_provincias_show', array('id' => $entity->getId())));
        }

        return $this->render('UbicacionBundle:Provincias:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Provincias entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UbicacionBundle:Provincias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Provincias entity.');
        }

        $editForm = $this->createForm(new ProvinciasType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UbicacionBundle:Provincias:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Provincias entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UbicacionBundle:Provincias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Provincias entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ProvinciasType(), $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pasantias_provincias_edit', array('id' => $id)));
        }

        return $this->render('UbicacionBundle:Provincias:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Provincias entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UbicacionBundle:Provincias')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Provincias entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pasantias_provincias'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
