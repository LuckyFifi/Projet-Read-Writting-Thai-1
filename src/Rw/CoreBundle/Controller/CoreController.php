<?php
// src/Rw/BlogBundle/Controller/CoreController.php

namespace Rw\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
    public function indexAction()
    {
        return $this->render('RwCoreBundle:Core:index.html.twig');
    }
}
