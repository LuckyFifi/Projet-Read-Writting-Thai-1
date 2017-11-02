<?php
// src/Rw/CoreBundle/Controller/CoreController.php

namespace Rw\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Rw\CoreBundle\Entity\Lesson;
use Rw\CoreBundle\Entity\Article;
use Rw\CoreBundle\Entity\Consonant;
use Rw\CoreBundle\Entity\Draw;
use Rw\CoreBundle\Form\LessonType;
use Rw\CoreBundle\Form\ArticleType;
use Rw\CoreBundle\Form\ConsonantType;
use Rw\CoreBundle\Form\DrawType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;



class CoreController extends Controller
{
    public function indexAction()
	// Accueil du site
    {
		return $this->render('RwCoreBundle:Core:index.html.twig');
    }
	
	public function listLessonAction()
	// Accueil des lessons - Affichage de la liste des leçons
	{
		$em = $this->getDoctrine()
				   ->getManager();
		$listLessons = $em->getRepository('RwCoreBundle:Lesson')
					      ->getLessonWithArticles();
		return $this->render('RwCoreBundle:Core:listLesson.html.twig', array(
			'lessons' 	=> $listLessons,
		));
	}
	
	public function viewLessonAction(Lesson $lesson)
	// Affichage de chaque leçons
	{
		$repository = $this->getDoctrine()
						   ->getManager()
					       ->getRepository('RwCoreBundle:Lesson');
		return $this->render('RwCoreBundle:Core:viewLesson.html.twig', array(	
			'lesson' => $lesson
		));
	}
	
	/**
	 * @Security("has_role('ROLE_ADMIN')")
     */ 
	public function addLessonAction()
	{
		$lesson = new Lesson();	
		// On crée le formulaire
		$form = $this->createForm(new LessonType, $lesson);	
		// On récupère la requête
		$request = $this->get('request');
		// On vérifie qu'elle est de type POST
		if ($request->getMethod() == 'POST') {
			// On fait le lien Requête <-> Formulaire
			// À partir de maintenant, la variable $lesson contient les valeurs entrées dans le formulaire
			$form->bind($request);
			// On vérifie que les valeurs entrées sont correctes
			if ($form->isValid()) {
				// On l'enregistre notre objet $lesson dans la base de données
				$em = $this->getDoctrine()->getManager();
				$em->persist($lesson);
				$em->flush();
				// On définit un message flash
				$this->get('session')->getFlashBag()->add('info', 'La leçon a bien été enregistrée !');
				// On redirige vers la page de visualisation de la nouvelle lesson
				return $this->redirect($this->generateUrl('rw_core_viewlesson', array('id' => $lesson->getId())));
			}
		}
		// À ce stade :
		// - Soit la requête est de type GET, donc on vient d'arriver sur la page et on veut voir le formulaire
		// - Soit la requête est de type POST, mais le formulaire n'est pas valide, donc on l'affiche de nouveau
		return $this->render('RwCoreBundle:Core:addLesson.html.twig', array(
		'form' => $form->createView(),
		));
		
	}
	
	/**
	 * @Security("has_role('ROLE_ADMIN')")
     */ 
	public function editLessonAction(Lesson $lesson)
	{
		// On récupère le repository
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository('RwCoreBundle:Lesson');
		// On crée le formulaire
		$form = $this->createForm(new LessonType, $lesson);	
		// On récupère la requête
		$request = $this->get('request');
		// On vérifie qu'elle est de type POST
		if ($request->getMethod() == 'POST') {
			// On fait le lien Requête <-> Formulaire
			// À partir de maintenant, la variable $lesson contient les valeurs entrées dans le formulaire
			$form->bind($request);
			// On vérifie que les valeurs entrées sont correctes
			if ($form->isValid()) {
				// On l'enregistre notre objet $lesson dans la base de données
				$em = $this->getDoctrine()->getManager();
				$em->persist($lesson);
				$em->flush();
				// On définit un message flash
				$this->get('session')->getFlashBag()->add('info', 'La leçon a bien été modifié !');
				// On redirige vers la page de visualisation de la leçon créé
				return $this->redirect($this->generateUrl('rw_core_viewlesson', array('id' => $lesson->getId())));
			}
		}
		// - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
		// - Soit la requête est de type POST, mais le formulaire n'est pas valide, donc on l'affiche de nouveau
		return $this->render('RwCoreBundle:Core:editLesson.html.twig', array(
		'form' => $form->createView(),
		));
	}
	
	/**
	 * @Security("has_role('ROLE_ADMIN')")
     */ 
	public function delLessonAction(Lesson $lesson)
	{
		// On récupère le repository
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository('RwCoreBundle:Lesson');
		// On crée un formulaire vide, qui ne contiendra que le champ CSRF
		// Cela permet de protéger la suppression d'article contre cette faille
		$form = $this->createFormBuilder()->getForm();
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
			if ($form->isValid()) { // Ici, isValid ne vérifie donc que le CSRF
				// suppression de la leçon
				$em->remove($lesson);
				$em->flush(); // Exécute un DELETE sur $lesson
				// On définit un message flash
				$this->get('session')->getFlashBag()->add('info', 'La leçon a été supprimée !');
		        // Puis on redirige vers l'accueil
				return $this->redirect($this->generateUrl('rw_core_list'));
			}
		}
		// Si la requète est en GET, on affiche une page de confirmation avant de supprimer
		return $this->render('RwCoreBundle:Core:deleteLesson.html.twig', array(
		'lesson' => $lesson,
		'form'    => $form->createView()
		));
	}
	
	/**
	 * @Security("has_role('ROLE_ADMIN')")
     */ 
	public function addArticleAction(Lesson $lesson)
	{
		$article = new Article();		
		$article->setLesson($lesson);
		// création de la liste des articles pour la vue twig
		$list_articles = $lesson->getArticles(); 
		$form = $this->createForm(new ArticleType, $article);
		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
			if ($form->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($article);
				$em->flush();
				// On définit un message flash
				$this->get('session')->getFlashBag()->add('info', "L'article a bien été enregistré !");
				return $this->redirect($this->generateUrl('rw_core_viewlesson', array('id' => $lesson->getId())));
			}
		}
		return $this->render('RwCoreBundle:Core:addarticle.html.twig', array(
		'form' => $form->createView(),
		'lesson' => $lesson,
		'articles' => $list_articles 
		));
	}
	
	public function editArticleAction($id)
	{
		// On récupère le repository
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository('RwCoreBundle:Article');
		// On récupère l'entité correspondant à l'id $id
		$article = $repository->find($id);
		$lesson = $article->getLesson();
		// $lesson est une instance de Rw\CoreBundle\Entity\Lesson
		// Ou null si aucune lesson n'a été trouvé avec l'id $id
		if($article === null)
		{
			throw $this->createNotFoundException('Article[id='.$id.'] inexistant.');
		}		
		// On crée le formulaire
		$form = $this->createForm(new ArticleType, $article);	
		// On récupère la requête
		$request = $this->get('request');
		// On vérifie qu'elle est de type POST
		if ($request->getMethod() == 'POST') {
			// On fait le lien Requête <-> Formulaire
			// À partir de maintenant, la variable $article contient les valeurs entrées dans le formulaire
			$form->bind($request);
			// On vérifie que les valeurs entrées sont correctes
			if ($form->isValid()) {
				// On l'enregistre notre objet $article dans la base de données
				$em = $this->getDoctrine()->getManager();
				$em->persist($article);
				$em->flush();
				// On définit un message flash
				$this->get('session')->getFlashBag()->add('info', "L'article a bien été modifié !");
				// On redirige vers la page de visualisation de l'article modifié
				return $this->redirect($this->generateUrl('rw_core_viewlesson', array('id' => $lesson->getId())));
			}
		}
		// - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
		// - Soit la requête est de type POST, mais le formulaire n'est pas valide, donc on l'affiche de nouveau
		return $this->render('RwCoreBundle:Core:editArticle.html.twig', array(
		'form' => $form->createView(),
		));
	}
	
	/**
	 * @Security("has_role('ROLE_ADMIN')")
     */ 
	public function addConsonantAction(Lesson $lesson)
	{
		$consonant = new Consonant();		
		$consonant->setLesson($lesson);
		// création de la liste des articles pour la vue twig
		$list_consonants = $lesson->getConsonants(); 
		$form = $this->createForm(new ConsonantType, $consonant);
		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
			if ($form->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($consonant);
				$em->flush();
				// On définit un message flash
				$this->get('session')->getFlashBag()->add('info', "La consonne a bien été enregistrée !");
				return $this->redirect($this->generateUrl('rw_core_viewlesson', array('id' => $lesson->getId())));
			}
		}
		return $this->render('RwCoreBundle:Core:addConsonant.html.twig', array(
		'form' => $form->createView(),
		'lesson' => $lesson,
		'consonants' => $list_consonants 
		));
	}
}
