<?php

namespace Pasantias\CurriculumBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Pasantias\CurriculumBundle\Entity\SubArea;
use Pasantias\CurriculumBundle\Form\SubAreaType;

/**
 * SubArea controller.
 *
 * @Route("/sub_area")
 */
class SubAreaController extends Controller
{
    /**
     * Lists all SubArea entities.
     *
     * @Route("/", name="sub_area")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CurriculumBundle:SubArea')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a SubArea entity.
     *
     * @Route("/{id}/show", name="sub_area_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CurriculumBundle:SubArea')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SubArea entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new SubArea entity.
     *
     * @Route("/new", name="sub_area_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new SubArea();
        $form   = $this->createForm(new SubAreaType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new SubArea entity.
     *
     * @Route("/create", name="sub_area_create")
     * @Method("POST")
     * @Template("CurriculumBundle:SubArea:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new SubArea();
        $form = $this->createForm(new SubAreaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('sub_area_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing SubArea entity.
     *
     * @Route("/{id}/edit", name="sub_area_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CurriculumBundle:SubArea')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SubArea entity.');
        }

        $editForm = $this->createForm(new SubAreaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing SubArea entity.
     *
     * @Route("/{id}/update", name="sub_area_update")
     * @Method("POST")
     * @Template("CurriculumBundle:SubArea:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CurriculumBundle:SubArea')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SubArea entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new SubAreaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('sub_area_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a SubArea entity.
     *
     * @Route("/{id}/delete", name="sub_area_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CurriculumBundle:SubArea')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SubArea entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('sub_area'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
