<?php

namespace Pasantias\CurriculumBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Pasantias\CurriculumBundle\Entity\TipoCarrera;
use Pasantias\CurriculumBundle\Form\TipoCarreraType;

/**
 * TipoCarrera controller.
 *
 * @Route("/tipo_carrera")
 */
class TipoCarreraController extends Controller {

    /**
     * Lists all TipoCarrera entities.
     *
     * @Route("/", name="tipo_carrera")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $tipoCarrera = $em->getRepository('CurriculumBundle:TipoCarrera')->findAll();

        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
                $tipoCarrera, $this->get('request')->query->get('page', 1)/* page number */, 10/* limit per page */
        );

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a TipoCarrera entity.
     *
     * @Route("/{id}/show", name="tipo_carrera_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CurriculumBundle:TipoCarrera')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoCarrera entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new TipoCarrera entity.
     *
     * @Route("/new", name="tipo_carrera_new")
     * @Template()
     */
    public function newAction() {
        $entity = new TipoCarrera();
        $form = $this->createForm(new TipoCarreraType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new TipoCarrera entity.
     *
     * @Route("/create", name="tipo_carrera_create")
     * @Method("POST")
     * @Template("CurriculumBundle:TipoCarrera:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new TipoCarrera();
        $form = $this->createForm(new TipoCarreraType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipo_carrera_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TipoCarrera entity.
     *
     * @Route("/{id}/edit", name="tipo_carrera_edit")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CurriculumBundle:TipoCarrera')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoCarrera entity.');
        }

        $editForm = $this->createForm(new TipoCarreraType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $editForm->createView(),
        );
    }

    /**
     * Edits an existing TipoCarrera entity.
     *
     * @Route("/{id}/update", name="tipo_carrera_update")
     * @Method("POST")
     * @Template("CurriculumBundle:TipoCarrera:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CurriculumBundle:TipoCarrera')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoCarrera entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TipoCarreraType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipo_carrera_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a TipoCarrera entity.
     *
     * @Route("/{id}/delete", name="tipo_carrera_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CurriculumBundle:TipoCarrera')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TipoCarrera entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tipo_carrera'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
