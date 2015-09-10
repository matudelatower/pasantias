<?php

namespace Pasantias\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Pasantias\UsuariosBundle\Form\RegistracionType;
use Pasantias\UsuariosBundle\Entity\Registracion;
use Pasantias\UsuariosBundle\Entity\Usuarios;

class DefaultController extends Controller {

    public function indexAction($name) {
        return $this->render('UsuariosBundle:Default:index.html.twig', array('name' => $name));
    }

    public function loginAction(Request $request) {

        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'UsuariosBundle:Default:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }

    public function registrarAction() {
        $form = $this->createForm(
                new RegistracionType(), new Usuarios()
        );

        return $this->render(
                        'UsuariosBundle:Default:registrar.html.twig', array('form' => $form->createView())
        );
    }

    public function createAction() {
        $em = $this->getDoctrine()->getEntityManager();

        $form = $this->createForm(new RegistracionType(), new Registracion());

        $form->handleRequest($this->getRequest());


        if ($form->isValid()) {
            $registration = $form->getData();
            $usuario = $registration->getUsuario();
            //
            $factory = $this->get('security.encoder_factory');


            $encoder = $factory->getEncoder($usuario);
            $password = $encoder->encodePassword($usuario->getPassword(), $usuario->getSalt());
            $usuario->setPassword($password);
            
            //

            $em->persist($usuario);
            $em->flush();

            return $this->redirect($this->generateUrl('login'));
        }

        return $this->render(
                        'UsuariosBundle:Default:registrar.html.twig', array('form' => $form->createView())
        );
    }

}
