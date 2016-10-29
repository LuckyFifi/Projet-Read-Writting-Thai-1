<?php

namespace Rw\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('RwForumBundle:Default:index.html.twig', array('name' => $name));
    }
}
