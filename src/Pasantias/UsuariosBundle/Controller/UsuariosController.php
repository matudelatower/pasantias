<?php

namespace Pasantias\UsuariosBundle\Controller;

use Pasantias\UsuariosBundle\Entity\Usuarios;
use Pasantias\UsuariosBundle\Form\ChangePasswordType;
use Pasantias\UsuariosBundle\Form\Model\ChangePassword;
use Pasantias\UsuariosBundle\Form\UsuariosType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Usuarios controller.
 *
 */
class UsuariosController extends Controller {

    /**
     * Lists all Usuarios entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $usuarios = $em->getRepository('UsuariosBundle:Usuarios')->findAll();

        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
                $usuarios, $this->get('request')->query->get('page', 1)/* page number */, 10/* limit per page */
        );

        return $this->render('UsuariosBundle:Usuarios:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Usuarios entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UsuariosBundle:Usuarios')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuarios entity.');
        }

//        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UsuariosBundle:Usuarios:show.html.twig', array(
                    'entity' => $entity,
//                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to create a new Usuarios entity.
     *
     */
    public function newAction() {
        $entity = new Usuarios();
        $form = $this->createForm(new UsuariosType(), $entity);

        return $this->render('UsuariosBundle:Usuarios:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new Usuarios entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Usuarios();
        $form = $this->createForm(new UsuariosType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $factory = $this->get('security.encoder_factory');

            $encoder = $factory->getEncoder($entity);
            $password = $encoder->encodePassword('123456', $entity->getSalt());
            $entity->setPassword($password);
            $entity->setActivo(TRUE);
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'success', 'Usuario creado Correctamente'
            );

            return $this->redirect($this->generateUrl('usuarios_edit', array('id' => $entity->getId())));
        }

        return $this->render('UsuariosBundle:Usuarios:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Usuarios entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UsuariosBundle:Usuarios')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuarios entity.');
        }

        $editForm = $this->createForm(new UsuariosType(), $entity);
//        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UsuariosBundle:Usuarios:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView(),
//                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Usuarios entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UsuariosBundle:Usuarios')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuarios entity.');
        }

//        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new UsuariosType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $factory = $this->get('security.encoder_factory');
            $form = $editForm->getData();
            $pass = $form->getPassword();
            if ($pass === "123456") {
                $encoder = $factory->getEncoder($entity);
                $password = $encoder->encodePassword('123456', $entity->getSalt());
                $entity->setPassword($password);
            }

            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'success', 'Cambios guardados Correctamente'
            );
            return $this->redirect($this->generateUrl('usuarios_edit', array('id' => $id)));
        }

        return $this->render('UsuariosBundle:Usuarios:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView(),
//                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Usuarios entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UsuariosBundle:Usuarios')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Usuarios entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pasantias_usuarios'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

    public function changePasswordAction(Request $request) {
        $changePasswordModel = new ChangePassword();
        $form = $this->createForm(new ChangePasswordType(), $changePasswordModel);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // perform some action,
            $user = $this->get('security.context')->getToken()->getUser();
            $encoder = $this->get('security.encoder_factory')->getEncoder($user);
            $plainPassword = $form["newPassword"]->getData();
            $password = $encoder->encodePassword($plainPassword, $user->getSalt());
            if ($password !== $user->getPassword()) {

                $user->setPassword($password);
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                // such as encoding with MessageDigestPasswordEncoder and persist
                $this->get('session')->getFlashBag()->add(
                        'success', 'Contraseña Actualizada Correctamente!'
                );
                return $this->redirect($this->generateUrl('pasantias_homepage'));
            } else {
                $this->get('session')->getFlashBag()->add(
                        'error', 'La contraseña no puede coincidir con la actual.'
                );
            }
        }

        return $this->render('UsuariosBundle:Usuarios:cambiarPassword.html.twig', array(
                    'form' => $form->createView(),
//                    'delete_form' => $deleteForm->createView(),
        ));
    }

}
