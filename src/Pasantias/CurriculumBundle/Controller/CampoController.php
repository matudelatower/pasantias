<?php

namespace Pasantias\CurriculumBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Pasantias\CurriculumBundle\Entity\Campo;
use Pasantias\CurriculumBundle\Form\CampoType;

/**
 * Campo controller.
 *
 * @Route("/campo")
 */
class CampoController extends Controller
{
    /**
     * Lists all Campo entities.
     *
     * @Route("/", name="campo")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CurriculumBundle:Campo')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Campo entity.
     *
     * @Route("/{id}/show", name="campo_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CurriculumBundle:Campo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Campo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Campo entity.
     *
     * @Route("/new", name="campo_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Campo();
        $form   = $this->createForm(new CampoType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Campo entity.
     *
     * @Route("/create", name="campo_create")
     * @Method("POST")
     * @Template("CurriculumBundle:Campo:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Campo();
        $form = $this->createForm(new CampoType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('campo_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Campo entity.
     *
     * @Route("/{id}/edit", name="campo_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CurriculumBundle:Campo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Campo entity.');
        }

        $editForm = $this->createForm(new CampoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Campo entity.
     *
     * @Route("/{id}/update", name="campo_update")
     * @Method("POST")
     * @Template("CurriculumBundle:Campo:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CurriculumBundle:Campo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Campo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CampoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('campo_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Campo entity.
     *
     * @Route("/{id}/delete", name="campo_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CurriculumBundle:Campo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Campo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('campo'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
