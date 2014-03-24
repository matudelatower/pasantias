<?php

namespace Pasantias\CurriculumBundle\Controller;

use DateTime;
use Pasantias\CurriculumBundle\Entity\Curriculum;
use Pasantias\CurriculumBundle\Entity\FormacionAcademica;
use Pasantias\CurriculumBundle\Entity\Persona;
use Pasantias\CurriculumBundle\Form\CurriculumPersonasType;
use Pasantias\CurriculumBundle\Form\CurriculumType;
use Pasantias\CurriculumBundle\Form\PersonaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Curriculum controller.
 *
 * @Route("/curriculum")
 */
class CurriculumController extends Controller {

    /**
     * Lists all Curriculum entities.
     *
     * @Route("/", name="curriculum")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        if ($this->get('security.context')->isGranted('ROLE_ALUMNO')) {
            $usuarioPersona = $this->get('security.context')->getToken()->getUser();
            if ($usuarioPersona->getPersona()) {
                $curriculum = $em->getRepository('CurriculumBundle:Curriculum')->findOneByPersona($usuarioPersona->getPersona());
                return $this->redirect($this->generateUrl('curriculum_edit', array('id' => $curriculum->getId())));
            } else {
                return $this->redirect($this->generateUrl('curriculum_new'));
            }
        } else {
            $curriculums = $em->getRepository('CurriculumBundle:Curriculum')->findAll();
            $paginator = $this->get('knp_paginator');
            $entities = $paginator->paginate(
                    $curriculums, $this->get('request')->query->get('page', 1)/* page number */, 10/* limit per page */
            );
        }


        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Curriculum entity.
     *
     * @Route("/{id}/show", name="curriculum_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CurriculumBundle:Curriculum')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Curriculum entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Curriculum entity.
     *
     * @Route("/new", name="curriculum_new")
     * @Template()
     */
    public function newAction() {
        $entity = new Curriculum();
//        $persona =new Persona();
//        $entity->setPersona($persona);
//        $form = $this->createForm(new CurriculumType(), $entity);
        $form = $this->createForm(new CurriculumPersonasType(), $entity);
//        $persona=new \Pasantias\CurriculumBundle\Entity\Persona;
//        $persona->setNombre("matias");
//        $entity->setPersona($persona);


        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Curriculum entity.
     *
     * @Route("/create", name="curriculum_create")
     * @Method("POST")
     * @Template("CurriculumBundle:Curriculum:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Curriculum();
//        $form = $this->createForm(new CurriculumType(), $entity);

        $form = $this->createForm(new CurriculumPersonasType(), $entity);

        $form->bind($request);

        if ($form->isValid()) {

            $entity->setFecha(new DateTime('now'));
            $persona = $entity->getPersona();

            $usuario = $this->get('security.context')->getToken()->getUser();

            $usuario->setPersona($persona);

            foreach ($entity->getPersona()->getDomicilio() as $domicilio) {
                $domicilio->setPersonas($persona);
            }
            foreach ($entity->getPersona()->getFormacionAcademica() as $formacionAcademicas) {
                $formacionAcademicas->setPersonas($persona);
            }
            foreach ($entity->getPersona()->getFormacionAcademicaSecundaria() as $formacionAcademicaSecundarias) {
                $formacionAcademicaSecundarias->setPersonas($persona);
            }
            foreach ($entity->getPersona()->getConocimientos() as $conocimientos) {
                $conocimientos->setPersonas($persona);
            }

            foreach ($entity->getPersona()->getAntecedenteLaboral() as $antecedenteLaboral) {
                $antecedenteLaboral->setPersonas($persona);
            }


            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                        'success', 'Curriculum creado correctamente.'
                );

            return $this->redirect($this->generateUrl('curriculum_edit', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Curriculum entity.
     *
     * @Route("/{id}/edit", name="curriculum_edit")
     * @Template()
     */
    public function editAction(Request $request, $id) {
        $domicilioOriginal = array();
        $antecentesOriginal = array();
        $formacionAcademicaSecundariaOriginal = array();
        $formacionAcademicaOriginal = array();
        $conocimientosOriginal = array();

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CurriculumBundle:Curriculum')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Curriculum entity.');
        }

        foreach ($entity->getPersona()->getDomicilio() as $domicilio) {
            $domicilioOriginal[] = $domicilio;
        }
        foreach ($entity->getPersona()->getFormacionAcademica() as $formacionAcademica) {
            $formacionAcademicaOriginal[] = $formacionAcademica;
        }
        foreach ($entity->getPersona()->getFormacionAcademicaSecundaria() as $formacionAcademicaSecundaria) {
            $formacionAcademicaSecundariaOriginal[] = $formacionAcademicaSecundaria;
        }
        foreach ($entity->getPersona()->getConocimientos() as $conocimientos) {
            $conocimientosOriginal[] = $conocimientos;
        }

        foreach ($entity->getPersona()->getAntecedenteLaboral() as $antecedenteLaboral) {
            $antecentesOriginal[] = $antecedenteLaboral;
        }

        $editForm = $this->createForm(new CurriculumPersonasType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        if ($request->isMethod("POST")) {
            $editForm->bind($request);
            if ($editForm->isValid()) {

                foreach ($entity->getPersona()->getDomicilio() as $domicilio) {

                    foreach ($domicilioOriginal as $key => $toDel) {
                        if ($toDel->getId() === $domicilio->getId()) {
                            unset($domicilioOriginal[$key]);
                        }
                    }
                }

                foreach ($domicilioOriginal as $domicilio) {
                    // remove the Address from the User


                    $entity->getPersona()->removeDomicilio($domicilio);

                    // if you wanted to delete the Address entirely, you can also do that
                    $em->remove($domicilio);
                }

                foreach ($entity->getPersona()->getDomicilio() as $domicilio) {
                    $domicilio->setPersonas($entity->getPersona());
                }

                //Formacion academica
                foreach ($entity->getPersona()->getFormacionAcademica() as $formacionAcademica) {

                    foreach ($formacionAcademicaOriginal as $key => $toDel) {
                        if ($toDel->getId() === $formacionAcademica->getId()) {
                            unset($formacionAcademicaOriginal[$key]);
                        }
                    }
                }

                foreach ($formacionAcademicaOriginal as $formacionAcademica) {
                    // remove the formacion academica from the User


                    $entity->getPersona()->removeFormacionAcademica($formacionAcademica);

                    // if you wanted to delete the academica entirely, you can also do that
                    $em->remove($formacionAcademica);
                }

                foreach ($entity->getPersona()->getFormacionAcademica() as $formacionAcademica) {
                    $formacionAcademica->setPersonas($entity->getPersona());
                }

                //Formacion academica Secundaria
                foreach ($entity->getPersona()->getFormacionAcademicaSecundaria() as $formacionAcademicaSecundaria) {

                    foreach ($formacionAcademicaSecundariaOriginal as $key => $toDel) {
                        if ($toDel->getId() === $formacionAcademicaSecundaria->getId()) {
                            unset($formacionAcademicaSecundariaOriginal[$key]);
                        }
                    }
                }

                foreach ($formacionAcademicaSecundariaOriginal as $formacionAcademicaSecundaria) {
                    // remove the formacion academica from the User


                    $entity->getPersona()->removeFormacionAcademicaSecundaria($formacionAcademicaSecundaria);

                    // if you wanted to delete the academica entirely, you can also do that
                    $em->remove($formacionAcademicaSecundaria);
                }

                foreach ($entity->getPersona()->getFormacionAcademicaSecundaria() as $formacionAcademicaSecundaria) {
                    $formacionAcademicaSecundaria->setPersonas($entity->getPersona());
                }


                //Conocimientos
                foreach ($entity->getPersona()->getConocimientos() as $conocimiento) {

                    foreach ($conocimientosOriginal as $key => $toDel) {
                        if ($toDel->getId() === $conocimiento->getId()) {
                            unset($conocimientosOriginal[$key]);
                        }
                    }
                }

                foreach ($conocimientosOriginal as $conocimiento) {
                    // remove the formacion academica from the User


                    $entity->getPersona()->removeConocimiento($conocimiento);

                    // if you wanted to delete the academica entirely, you can also do that
                    $em->remove($conocimiento);
                }

                foreach ($entity->getPersona()->getConocimientos() as $conocimiento) {
                    $conocimiento->setPersonas($entity->getPersona());
                }

                //Antecedente Laboral
                foreach ($entity->getPersona()->getAntecedenteLaboral() as $antecedenteLaboral) {

                    foreach ($antecentesOriginal as $key => $toDel) {
                        if ($toDel->getId() === $antecedenteLaboral->getId()) {
                            unset($antecentesOriginal[$key]);
                        }
                    }
                }

                foreach ($antecentesOriginal as $antecedenteLaboral) {
                    // remove the formacion academica from the User


                    $entity->getPersona()->removeAntecedenteLaboral($antecedenteLaboral);

                    // if you wanted to delete the academica entirely, you can also do that
                    $em->remove($antecedenteLaboral);
                }

                foreach ($entity->getPersona()->getAntecedenteLaboral() as $antecedenteLaboral) {
                    $antecedenteLaboral->setPersonas($entity->getPersona());
                }

                $em->persist($entity);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                        'success', 'Curriculum actualizado correctamente.'
                );

                return $this->redirect($this->generateUrl('curriculum_edit', array('id' => $id)));
            }
        }

        return array(
            'entity' => $entity,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Curriculum entity.
     *
     * @Route("/{id}/update", name="curriculum_update")
     * @Method("POST")
     * @Template("CurriculumBundle:Curriculum:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CurriculumBundle:Curriculum')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Curriculum entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CurriculumType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('curriculum_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Curriculum entity.
     *
     * @Route("/{id}/delete", name="curriculum_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CurriculumBundle:Curriculum')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Curriculum entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('curriculum'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

    /**
     * @Route("/area", name="select_area")
     * @Template()
     */
    public function areaAction() {
        //$country_id = $this->getRequest()->request->get('country_id');

        $em = $this->getDoctrine()->getManager();

        $area = $em->getRepository('CurriculumBundle:Area')->findAll();

        return array(
            'area' => $area
        );
    }

    /**
     * @Route("/subareas", name="select_subareas")
     * @Template()
     */
    public function subareasAction() {
        $area_id = $this->getRequest()->request->get('area_id');

        $em = $this->getDoctrine()->getManager();

        $area = $em->getRepository('CurriculumBundle:Area')->findById($area_id);

        $subArea = $em->getRepository('CurriculumBundle:SubArea')->findByArea($area);

        return array(
            'subAreas' => $subArea
        );
    }

    public function imprimirAction($id) {
        $em = $this->getDoctrine()->getManager();
        $curriculum = $em->getRepository('CurriculumBundle:Curriculum')->findOneById($id);


        
        $html = $this->renderView('CurriculumBundle:Curriculum:curriculum.pdf.twig', array(
            "curriculum" => $curriculum
        ));
//        return new Response($html);

        return new Response(
                $this->get('knp_snappy.pdf')->getOutputFromHtml($html, array('margin-left' => '1cm',
                    'margin-right' => '1cm',
                    'margin-top' => '1cm',
                    'margin-bottom' => '1cm',
                )), 200, array(
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="Curriculum de ' . $curriculum->getPersona()->getNombre() .
            ' ' . $curriculum->getPersona()->getApellido() . '.pdf"'
                )
        );
    }

}
