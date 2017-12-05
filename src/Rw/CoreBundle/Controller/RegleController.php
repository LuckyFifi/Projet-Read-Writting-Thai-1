<?php
// src/Rw/CoreBundle/Controller/RegleController.php

namespace Rw\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Rw\CoreBundle\Entity\Consonant;
use Rw\CoreBundle\Entity\Draw;
use Rw\CoreBundle\Entity\Picture;
use Rw\CoreBundle\Entity\Police;
use Rw\CoreBundle\Entity\Police2;
use Rw\CoreBundle\Form\ConsonantType;
use Rw\CoreBundle\Form\DrawType;
use Rw\CoreBundle\Form\PictureType;
use Rw\CoreBundle\Form\PoliceType;
use Rw\CoreBundle\Form\Police2Type;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;



class RegleController extends Controller
{
    public function indexAction()
	// Accueil du site
    {
		return $this->render('RwCoreBundle:Core:indexRegle.html.twig');
    }
}
