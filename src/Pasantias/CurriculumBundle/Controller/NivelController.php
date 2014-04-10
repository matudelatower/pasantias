<?php

namespace Pasantias\CurriculumBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Pasantias\CurriculumBundle\Entity\Nivel;
use Pasantias\CurriculumBundle\Form\NivelType;

/**
 * Nivel controller.
 *
 * @Route("/nivel")
 */
class NivelController extends Controller {

    /**
     * Lists all Nivel entities.
     *
     * @Route("/", name="nivel")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $niveles = $em->getRepository('CurriculumBundle:Nivel')->findAll();

        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
                $niveles, $this->get('request')->query->get('page', 1)/* page number */, 10/* limit per page */
        );

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Nivel entity.
     *
     * @Route("/{id}/show", name="nivel_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CurriculumBundle:Nivel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nivel entity.');
        }



        return array(
            'entity' => $entity,
        );
    }

    /**
     * Displays a form to create a new Nivel entity.
     *
     * @Route("/new", name="nivel_new")
     * @Template()
     */
    public function newAction() {
        $entity = new Nivel();
        $form = $this->createForm(new NivelType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Nivel entity.
     *
     * @Route("/create", name="nivel_create")
     * @Method("POST")
     * @Template("CurriculumBundle:Nivel:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Nivel();
        $form = $this->createForm(new NivelType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add(
                    'success', 'Nivel creado correctamente.'
            );

            return $this->redirect($this->generateUrl('nivel'));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Nivel entity.
     *
     * @Route("/{id}/edit", name="nivel_edit")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CurriculumBundle:Nivel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nivel entity.');
        }

        $editForm = $this->createForm(new NivelType(), $entity);


        return array(
            'entity' => $entity,
            'form' => $editForm->createView(),
        );
    }

    /**
     * Edits an existing Nivel entity.
     *
     * @Route("/{id}/update", name="nivel_update")
     * @Method("POST")
     * @Template("CurriculumBundle:Nivel:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CurriculumBundle:Nivel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nivel entity.');
        }


        $editForm = $this->createForm(new NivelType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

           $this->get('session')->getFlashBag()->add(
                    'success', 'Nivel modificado correctamente.'
            );

            return $this->redirect($this->generateUrl('nivel'));
        }

        return array(
            'entity' => $entity,
            'form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Nivel entity.
     *
     * @Route("/{id}/delete", name="nivel_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CurriculumBundle:Nivel')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Nivel entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('nivel'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
