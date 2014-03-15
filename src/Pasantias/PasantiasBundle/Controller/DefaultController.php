<?php

namespace Pasantias\PasantiasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PasantiasBundle:Default:index.html.twig');
    }
    public function portadaAction()
    {
        return $this->render('PasantiasBundle:Default:index.html.twig');
        
       
    }
    
}
