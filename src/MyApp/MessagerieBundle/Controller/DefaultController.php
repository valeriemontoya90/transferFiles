<?php

namespace MyApp\MessagerieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MyAppMessagerieBundle:Default:index.html.twig', array('name' => $name));
    }
}
