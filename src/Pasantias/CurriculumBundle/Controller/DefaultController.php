<?php

namespace Pasantias\CurriculumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CurriculumBundle:Default:index.html.twig', array('name' => $name));
    }
}
