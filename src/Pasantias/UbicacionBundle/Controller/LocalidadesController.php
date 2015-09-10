<?php

namespace Pasantias\UbicacionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pasantias\UbicacionBundle\Entity\Localidades;
use Pasantias\UbicacionBundle\Form\LocalidadesType;

/**
 * Localidades controller.
 *
 */
class LocalidadesController extends Controller {

    /**
     * Lists all Localidades entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $localidades = $em->getRepository('UbicacionBundle:Localidades')->findAll();

        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
                $localidades, $this->get('request')->query->get('page', 1)/* page number */, 10/* limit per page */
        );

        return $this->render('UbicacionBundle:Localidades:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Localidades entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UbicacionBundle:Localidades')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Localidades entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UbicacionBundle:Localidades:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to create a new Localidades entity.
     *
     */
    public function newAction() {
        $entity = new Localidades();
        $form = $this->createForm(new LocalidadesType(), $entity);

        return $this->render('UbicacionBundle:Localidades:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new Localidades entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Localidades();
        $form = $this->createForm(new LocalidadesType(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pasantias_localidades_show', array('id' => $entity->getId())));
        }

        return $this->render('UbicacionBundle:Localidades:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Localidades entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UbicacionBundle:Localidades')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Localidades entity.');
        }

        $editForm = $this->createForm(new LocalidadesType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UbicacionBundle:Localidades:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Localidades entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UbicacionBundle:Localidades')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Localidades entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new LocalidadesType(), $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pasantias_localidades_edit', array('id' => $id)));
        }

        return $this->render('UbicacionBundle:Localidades:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Localidades entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UbicacionBundle:Localidades')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Localidades entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pasantias_localidades'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
