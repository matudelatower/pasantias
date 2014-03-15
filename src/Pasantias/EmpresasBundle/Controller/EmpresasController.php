<?php

namespace Pasantias\EmpresasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Pasantias\EmpresasBundle\Entity\Empresas;
use Pasantias\EmpresasBundle\Form\EmpresasType;
use Pasantias\EmpresasBundle\Form\DomicilioEmpresasType;
use Pasantias\CurriculumBundle\Entity\Domicilio;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

//use Pasantias\CurriculumBundle\Entity\Domicilio;

/**
 * Empresas controller.
 *
 * @Route("/empresas")
 */
class EmpresasController extends Controller {

    /**
     * Lists all Empresas entities.
     *
     * @Route("/", name="empresas")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EmpresasBundle:Empresas')->findAll();

        if ($this->get('security.context')->isGranted('ROLE_EMPRESA')) {
            $usuarioEmpresa = $this->get('security.context')->getToken()->getUser();
            if ($usuarioEmpresa->getEmpresa()) {
                $empresa = $em->getRepository('EmpresasBundle:Empresas')->find($usuarioEmpresa->getEmpresa());
                return $this->redirect($this->generateUrl('empresas_edit', array('id' => $empresa->getId())));
            } else {
                return $this->redirect($this->generateUrl('empresas_new'));
            }
        } else {
            return array(
                'entities' => $entities,
            );
        }
    }

    /**
     * Finds and displays a Empresas entity.
     *
     * @Route("/{id}/show", name="empresas_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmpresasBundle:Empresas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empresas entity.');
        }



        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Empresas entity.
     *
     * @Route("/new", name="empresas_new")
     * @Template()
     */
    public function newAction() {
        $entity = new Empresas();
        $form = $this->createForm(new DomicilioEmpresasType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );

//         $empresa = new Empresas();
//
//        $form = $this->createForm(new \Pasantias\CurriculumBundle\Form\DomicilioType(), $empresa);
//
//        if ($request->isMethod("POST")) {
//            $form->bind($request);
//
//            if ($form->isValid()) {
//                $em = $this->getDoctrine()->getManager();
//
//                $em->persist($empresa);
//                // $em->flush();
//
//                $flashBag = $this->get('session')->getFlashBag();
//                $flashBag->add('smtc_success', 'Se ha creado una empresa:');
//                $flashBag->add('smtc_success', sprintf('Username: %s', $empresa->getNombreEmpresa()));
//                if (0 !== count($empresa->getDomicilio())) {
//                    $flashBag->add('smtc_success', 'Direcciones:');
//                    foreach ($empresa->getDomicilio() as $domicilio) {
//                        $flashBag->add('smtc_success', sprintf('&nbsp;&nbsp;%s (%s)', $domicilio->getCalle(), $domicilio->getLocalidad()->getNombreLocalidad()));
//                    }
//                }
//
//                return $this->redirect($this->generateUrl('empresas'));
//            }
//        }
//
//        return array(
//            'form' => $form->createView()
//        );
    }

    /**
     * Creates a new Empresas entity.
     * 
     */
    public function createAction(Request $request) {
        $entity = new Empresas();
        $form = $this->createForm(new DomicilioEmpresasType(), $entity);

        $form->bind($request);
        if ($form->isValid()) {
            $empresa = $entity->getEmpresa();

            $usuario = $this->get('security.context')->getToken()->getUser();

            $usuario->setEmpresa($empresa);

            foreach ($entity->getDomicilio() as $domicilio) {
                $domicilio->setEmpresas($entity);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('empresas_show', array('id' => $entity->getId())));
        }

        return $this->render('EmpresasBundle:Empresas:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
//        $entity = new Empresas();
//        $form = $this->createForm(new EmpresasType(), $entity);
//
//        if ($request->isMethod("POST")) {
//            $form->bind($request);
//
//            if ($form->isValid()) {
//                $em = $this->getDoctrine()->getManager();
//                $em->persist($entity);
//                //$em->flush();
//
//               
//                
//                return $this->redirect($this->generateUrl('empresas_show', array('id' => $entity->getId())));
//                //return $this->redirect($this->generateUrl('empresas'));
//            }
//
//            return array(
//                'form' => $form->createView()
//            );
//        }
    }

    /**
     * Displays a form to edit an existing Empresas entity.
     *
     * @Route("/{id}/edit", name="empresas_edit")
     * @Template()
     */
    public function editAction(Request $request, $id) {
        // Original editAction
//        $em = $this->getDoctrine()->getManager();
//
//
//
//        $entity = $em->getRepository('EmpresasBundle:Empresas')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Empresas entity.');
//        }
//        $domicilioOriginal = array();
//
//        foreach ($entity->getDomicilio() as $domicilio) {
//
//            $domicilioOriginal[] = $domicilio;
//        }
//
//        $editForm = $this->createForm(new DomicilioEmpresasType(), $entity);
//        $deleteForm = $this->createDeleteForm($id);
//
//        return array(
//            'entity' => $entity,
//            'edit_form' => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        );

        $domicilioOriginal = array();

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmpresasBundle:Empresas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empresas entity.');
        }

        foreach ($entity->getDomicilio() as $domicilio) {

            $domicilioOriginal[] = $domicilio;
        }

        $editForm = $this->createForm(new DomicilioEmpresasType(), $entity);
        $deleteForm = $this->createDeleteForm($id);


        if ($request->isMethod("POST")) {
            $editForm->bind($request);
            if ($editForm->isValid()) {

                foreach ($entity->getDomicilio() as $domicilio) {

                    foreach ($domicilioOriginal as $key => $toDel) {
                        if ($toDel->getId() === $domicilio->getId()) {
                            unset($domicilioOriginal[$key]);
                        }
                    }
                }

                foreach ($domicilioOriginal as $domicilio) {
                    // remove the Address from the User


                    $entity->removeDomicilio($domicilio);

                    // if you wanted to delete the Address entirely, you can also do that
                    $em->remove($domicilio);
                }

                foreach ($entity->getDomicilio() as $domicilio) {
                    $domicilio->setEmpresas($entity);
                }

                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('empresas_edit', array('id' => $id)));
            }
        }
        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Empresas entity.
     *
     * @Route("/{id}/update", name="empresas_update")
     * @Method("POST")
     * @Template("EmpresasBundle:Empresas:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();


        $entity = $em->getRepository('EmpresasBundle:Empresas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empresas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new DomicilioEmpresasType(), $entity);
        $editForm->bind($request);


        if ($editForm->isValid()) {

            $domicilioOriginal[] = $request->request->get('domic');


            foreach ($entity->getDomicilio() as $domicilio) {

                foreach ($domicilioOriginal as $key => $toDel) {
                    if ($toDel->getId() === $domicilio->getId()) {
                        unset($domicilioOriginal[$key]);
                    }
                }
            }

            // remove the relationship between the address and the Task
            foreach ($domicilioOriginal as $domicilio) {
                // remove the Address from the User

                $_domicilio = $em->getRepository('CurriculumBundle:Domicilio')->find($domicilio['id']);
                $entity->removeDomicilio($_domicilio);

                // if you wanted to delete the Address entirely, you can also do that
                $em->remove($domicilio);
            }

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('empresas_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Empresas entity.
     *
     * @Route("/{id}/delete", name="empresas_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EmpresasBundle:Empresas')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Empresas entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('empresas'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

    /**
     * @Route("/provincias", name="select_provincias")
     * @Template()
     */
    public function provinciasAction() {
        //$country_id = $this->getRequest()->request->get('country_id');

        $em = $this->getDoctrine()->getManager();

        $provincias = $em->getRepository('UbicacionBundle:Provincias')->findAll();

        return array(
            'provincias' => $provincias
        );
    }

    /**
     * @Route("/localidades", name="select_localidades")
     * @Template()
     */
    public function localidadesAction() {
        $provincia_id = $this->getRequest()->request->get('province_id');

        $em = $this->getDoctrine()->getManager();

        $provincia = $em->getRepository('UbicacionBundle:Provincias')->findById($provincia_id);

        $localidades = $em->getRepository('UbicacionBundle:Localidades')->findByProvincias($provincia);

        return array(
            'localidades' => $localidades
        );
    }

}
