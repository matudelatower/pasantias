<?php

namespace Pasantias\EmpresasBundle\Controller;

use Pasantias\CurriculumBundle\Entity\Persona;
use Pasantias\PasantiasBundle\Entity\Empresas;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();

        $Empresas = $em->getRepository('PasantiasBundle:Empresas')->findAll();
//                findBy(array(
//            'idArticulo' => 1
//                ));


        return $this->render(
                        'EmpresasBundle:Default:index.html.twig', array('Empresas' => $Empresas)
        );
    }

    public function newAction(Request $request) {
        // crea una task y le asigna algunos datos ficticios para este ejemplo
        $empresas = new \Pasantias\PasantiasBundle\Form\EmpresasType();
//        $provincias->setTask('Write a blog post');
//        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($empresas)
                ->add('Name', 'text')
                ->getForm();


        return $this->render('EmpresasBundle:Default:new.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function solicitudesNuevasAction(Persona $idPersona) {
        $em = $this->getDoctrine()->getManager();

        $consulta = $em->createQuery('
        SELECT count(s)
        FROM EmpresasBundle:Solicitudes s
        LEFT JOIN s.solicitudNueva sn 
        WHERE sn.visto = false
        OR sn.visto IS NULL
        ');
        $notificaciones = $consulta->getResult()[0][1];

        return $this->render(
                        'EmpresasBundle:Default:notificaciones.html.twig', array('notificaciones' => $notificaciones)
        );
    }

}
