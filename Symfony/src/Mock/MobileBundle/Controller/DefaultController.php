<?php

namespace Mock\MobileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('MockMobileBundle:Default:index.html.twig', array('name' => $name));
    }
    public function navAction()
    {
        return $this->render('MockMobileBundle:Default:nav.html.twig');
    }
}
