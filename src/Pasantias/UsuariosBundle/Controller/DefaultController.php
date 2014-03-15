<?php

namespace Pasantias\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Response;
use Pasantias\UsuariosBundle\Form\RegistracionType;
use Pasantias\UsuariosBundle\Entity\Registracion;
use Pasantias\UsuariosBundle\Entity\Usuarios;

class DefaultController extends Controller {

    public function indexAction($name) {
        return $this->render('UsuariosBundle:Default:index.html.twig', array('name' => $name));
    }

    public function loginAction() {
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('UsuariosBundle:Default:login.html.twig', array(
                    // last username entered by the user
                    'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                    'error' => $error,
        ));
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

        $form->bind($this->getRequest());


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
