<?php

namespace Pasantias\CurriculumBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Pasantias\CurriculumBundle\Entity\Area;
use Pasantias\CurriculumBundle\Form\AreaType;

/**
 * Area controller.
 *
 * @Route("/area")
 */
class AreaController extends Controller {

    /**
     * Lists all Area entities.
     *
     * @Route("/", name="area")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $area = $em->getRepository('CurriculumBundle:Area')->findAll();
        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
                $area, $this->get('request')->query->get('page', 1)/* page number */, 10/* limit per page */
        );


        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Area entity.
     *
     * @Route("/{id}/show", name="area_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CurriculumBundle:Area')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Area entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Area entity.
     *
     * @Route("/new", name="area_new")
     * @Template()
     */
    public function newAction() {
        $entity = new Area();
        $form = $this->createForm(new AreaType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Area entity.
     *
     * @Route("/create", name="area_create")
     * @Method("POST")
     * @Template("CurriculumBundle:Area:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Area();
        $form = $this->createForm(new AreaType(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'success', 'Area creada correctamente.'
            );

            return $this->redirect($this->generateUrl('area'));
//            return $this->redirect($this->generateUrl('area_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Area entity.
     *
     * @Route("/{id}/edit", name="area_edit")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CurriculumBundle:Area')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Area entity.');
        }

        $editForm = $this->createForm(new AreaType(), $entity);


        return array(
            'entity' => $entity,
            'form' => $editForm->createView(),
        );
    }

    /**
     * Edits an existing Area entity.
     *
     * @Route("/{id}/update", name="area_update")
     * @Method("POST")
     * @Template("CurriculumBundle:Area:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CurriculumBundle:Area')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Area entity.');
        }


        $editForm = $this->createForm(new AreaType(), $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('area_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Area entity.
     *
     * @Route("/{id}/delete", name="area_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CurriculumBundle:Area')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Area entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('area'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
