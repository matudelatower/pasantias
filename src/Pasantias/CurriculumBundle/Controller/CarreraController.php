<?php

namespace Pasantias\CurriculumBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Pasantias\CurriculumBundle\Entity\Carrera;
use Pasantias\CurriculumBundle\Form\CarreraType;

/**
 * Carrera controller.
 *
 * @Route("/carrera")
 */
class CarreraController extends Controller
{
    /**
     * Lists all Carrera entities.
     *
     * @Route("/", name="carrera")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $carreras = $em->getRepository('CurriculumBundle:Carrera')->findAll();
        
        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
                $carreras, $this->get('request')->query->get('page', 1)/* page number */, 10/* limit per page */
        );

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Carrera entity.
     *
     * @Route("/{id}/show", name="carrera_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CurriculumBundle:Carrera')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carrera entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Carrera entity.
     *
     * @Route("/new", name="carrera_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Carrera();
        $form   = $this->createForm(new CarreraType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Carrera entity.
     *
     * @Route("/create", name="carrera_create")
     * @Method("POST")
     * @Template("CurriculumBundle:Carrera:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Carrera();
        $form = $this->createForm(new CarreraType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('carrera_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Carrera entity.
     *
     * @Route("/{id}/edit", name="carrera_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CurriculumBundle:Carrera')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carrera entity.');
        }

        $editForm = $this->createForm(new CarreraType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Carrera entity.
     *
     * @Route("/{id}/update", name="carrera_update")
     * @Method("POST")
     * @Template("CurriculumBundle:Carrera:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CurriculumBundle:Carrera')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carrera entity.');
        }

        
        $editForm = $this->createForm(new CarreraType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('carrera_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),            
        );
    }

    /**
     * Deletes a Carrera entity.
     *
     * @Route("/{id}/delete", name="carrera_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CurriculumBundle:Carrera')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Carrera entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('carrera'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
