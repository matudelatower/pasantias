<?php

namespace Pasantias\UbicacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('UbicacionBundle:Default:index.html.twig', array('name' => $name));
    }
}