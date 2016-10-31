<?php
// src/Rw/ForumBundle/Controller/ForumController.php

namespace Rw\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ForumController extends Controller
{
    public function indexAction()
    {
		$content = $this->get('templating')->render('RwForumBundle:Forum:index.html.twig');
		return new Response($content);
    }
}
