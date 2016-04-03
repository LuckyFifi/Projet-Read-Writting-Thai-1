<?php

// src/Rw/BlogBundle/Controller/BlogController.php

namespace Rw\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Rw\BlogBundle\Entity\Billet;
use Rw\BlogBundle\Entity\Comment;
use Rw\BlogBundle\Form\BilletType;
use Rw\BlogBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class BlogController extends Controller
{
	public function indexAction($page)
	{
		$repository = $this->getDoctrine()
						   ->getManager()
						   ->getRepository('RwBlogBundle:Billet');	
		$billets = $repository->getBillets(3, $page);
		return $this->render('RwBlogBundle:Blog:index.html.twig', array(
			'billets'   => $billets,
			'page'       => $page,
			'nombrePage' => ceil(count($billets)/3)
		));
	}
	
	public function listAction($page)
	{
		$repository = $this->getDoctrine()
						->getManager()
						->getRepository('RwBlogBundle:Billet');
		$billets = $repository->getBillets(4, $page);		
		return $this->render('RwBlogBundle:Blog:list.html.twig', array(
		'billets' => $billets,
		'page'       => $page,
		'nombrePage' => ceil(count($billets)/4)
		));
	}
	
	public function viewAction($id)
	{
		// On récupère le repository
		$repository = $this->getDoctrine()
						   ->getManager()
					       ->getRepository('RwBlogBundle:Billet');
		// On récupère l'entité correspondant à l'id $id
		$billet = $repository->find($id);
		// $billet est une instance de Rw\BlogBundle\Entity\Billet
		// Ou null si aucun billet n'a été trouvé avec l'id $id
		if($billet === null)
		{
			throw $this->createNotFoundException('Billet[id='.$id.'] inexistant.');
		}
		$list_comments = $billet->getComments();
		return $this->render('RwBlogBundle:Blog:view.html.twig', array(
			'billet' => $billet,
			'comments' => $list_comments
		));
	}
	
	public function addAction()
	{
	// On vérifie que l'utilisateur dispose bien du rôle ROLE_AUTEUR
    if (!$this->get('security.context')->isGranted('ROLE_USER')) {
		// Sinon on déclenche une exception « Accès interdit »
		throw new AccessDeniedException('Accès limité aux personnes connectées.');
    }
		// On crée un objet Billet
		$billet = new Billet();
		// champs préremplis
		$billet->setAuthor('LuckyFifi');	
		// On crée le formulaire
		$form = $this->createForm(new BilletType, $billet);	
		// On récupère la requête
		$request = $this->get('request');
		// On vérifie qu'elle est de type POST
		if ($request->getMethod() == 'POST') {
			// On fait le lien Requête <-> Formulaire
			// À partir de maintenant, la variable $billet contient les valeurs entrées dans le formulaire par le visiteur
			$form->bind($request);
			// On vérifie que les valeurs entrées sont correctes
			if ($form->isValid()) {
				// On l'enregistre notre objet $billet dans la base de données
				$em = $this->getDoctrine()->getManager();
				$em->persist($billet);
				$em->flush();
				// On définit un message flash
				$this->get('session')->getFlashBag()->add('info', 'Le billet a bien été enregistré !');
				// On redirige vers la page de visualisation du billet nouvellement créé
				return $this->redirect($this->generateUrl('rwblog_view', array('id' => $billet->getId())));
			}
		}
		// À ce stade :
		// - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
		// - Soit la requête est de type POST, mais le formulaire n'est pas valide, donc on l'affiche de nouveau
		return $this->render('RwBlogBundle:Blog:add.html.twig', array(
		'form' => $form->createView(),
		));
	}
	
	public function addCommentAction(Billet $billet)
	{
		// On vérifie que l'utilisateur dispose bien du rôle ROLE_AUTEUR
		if (!$this->get('security.context')->isGranted('ROLE_USER')) {
			// Sinon on déclenche une exception « Accès interdit »
			throw new AccessDeniedException('Accès limité aux personnes connectées.');
		}
		$user = $this->getUser();
		$comment = new Comment();
		if (null === $user) {
			// Ici, l'utilisateur est anonyme ou l'URL n'est pas derrière un pare-feu
			throw new AccessDeniedException('Accès limité aux personnes connectées.');
		} else {
			$comment->setUser($user);
		}		
		$comment->setBillet($billet);
		$comment->setAuthor($user);
		// création de la liste des commentaires pour la vue twig
		$list_comments = $billet->getComments(); //
		$form = $this->createForm(new CommentType, $comment);
		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
			if ($form->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($comment);
				$em->flush();
				// On définit un message flash
				$this->get('session')->getFlashBag()->add('info', 'Le commentaire a bien été enregistré !');
				return $this->redirect($this->generateUrl('rwblog_view', array('id' => $billet->getId())));
			}
		}
		return $this->render('RwBlogBundle:Blog:addcomment.html.twig', array(
		'form' => $form->createView(),
		'billet' => $billet,
		'comments' => $list_comments 
		));
	}
	
	/**
	 * @Security("has_role('ROLE_ADMIN')")
     */ 
	public function deleteAction($id)
	{
		// On récupère le repository
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository('RwBlogBundle:Billet');
		// On récupère l'entité correspondant à l'id $id
		$billet = $repository->find($id);
		// $billet est une instance de Rw\BlogBundle\Entity\Billet
		// Ou null si aucun billet n'a été trouvé avec l'id $id
		if($billet === null)
		{
			throw $this->createNotFoundException('Billet[id='.$id.'] inexistant.');
		}
		// On crée un formulaire vide, qui ne contiendra que le champ CSRF
		// Cela permet de protéger la suppression d'article contre cette faille
		$form = $this->createFormBuilder()->getForm();
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
			if ($form->isValid()) { // Ici, isValid ne vérifie donc que le CSRF
				// suppression du billet
				$em->remove($billet);
				$em->flush(); // Exécute un DELETE sur $billet
				// On définit un message flash
				$this->get('session')->getFlashBag()->add('info', 'Le billet a bien été supprimé !');
		        // Puis on redirige vers l'accueil
				return $this->redirect($this->generateUrl('rwblog_home'));
			}
		}
		// Si la requète est en GET, on affiche une page de confirmation avant de supprimer
		return $this->render('RwBlogBundle:Blog:delete.html.twig', array(
		'billet' => $billet,
		'form'    => $form->createView()
		));
	}
	
	/**
	 * @Security("has_role('ROLE_USER')")
     */ 
	public function editCommentAction($id)
	{
		// On récupère le repository
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository('RwBlogBundle:Comment');
		// On récupère l'entité correspondant à l'id $id
		$comment = $repository->find($id);
		$billet = $comment->getBillet();
		// $billet est une instance de Rw\BlogBundle\Entity\Billet
		// Ou null si aucun billet n'a été trouvé avec l'id $id
		if($comment === null)
		{
			throw $this->createNotFoundException('Comment[id='.$id.'] inexistant.');
		}
		$user = $this->getUser();
		$auteur = $comment->getAuthor();
		// On vérifie que l'utilisateur est bien l'auteur du commentaire
		if ($user != $auteur ) {
			// Sinon on vérifie que l'utilisateur dispose bien du rôle ROLE_ADMIN
			if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
				// Sinon on déclenche une exception « Accès interdit »
				throw new AccessDeniedException('Accès limité à l\'auteur de ce commentaire...');
			}
		}
		// On crée le formulaire
		$form = $this->createForm(new CommentType, $comment);	
		// On récupère la requête
		$request = $this->get('request');
		// On vérifie qu'elle est de type POST
		if ($request->getMethod() == 'POST') {
			// On fait le lien Requête <-> Formulaire
			// À partir de maintenant, la variable $comment contient les valeurs entrées dans le formulaire par le visiteur
			$form->bind($request);
			// On vérifie que les valeurs entrées sont correctes
			if ($form->isValid()) {
				// On l'enregistre notre objet $comment dans la base de données
				$em = $this->getDoctrine()->getManager();
				$em->persist($comment);
				$em->flush();
				// On définit un message flash
				$this->get('session')->getFlashBag()->add('info', 'Le commentaire a bien été modifié !');
				// On redirige vers la page de visualisation du commentaire modifié
				return $this->redirect($this->generateUrl('rwblog_view', array('id' => $billet->getId())));
			}
		}
		// À ce stade :
		// - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
		// - Soit la requête est de type POST, mais le formulaire n'est pas valide, donc on l'affiche de nouveau
		return $this->render('RwBlogBundle:Blog:editComment.html.twig', array(
		'form' => $form->createView(),
		));
	}
	public function editAction($id)
	{
		// On récupère le repository
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository('RwBlogBundle:Billet');
		// On récupère l'entité correspondant à l'id $id
		$billet = $repository->find($id);
		// $billet est une instance de Rw\BlogBundle\Entity\Billet
		// Ou null si aucun billet n'a été trouvé avec l'id $id
		if($billet === null)
		{
			throw $this->createNotFoundException('Billet[id='.$id.'] inexistant.');
		}
		// On crée le formulaire
		$form = $this->createForm(new BilletType, $billet);	
		// On récupère la requête
		$request = $this->get('request');
		// On vérifie qu'elle est de type POST
		if ($request->getMethod() == 'POST') {
			// On fait le lien Requête <-> Formulaire
			// À partir de maintenant, la variable $billet contient les valeurs entrées dans le formulaire par le visiteur
			$form->bind($request);
			// On vérifie que les valeurs entrées sont correctes
			if ($form->isValid()) {
				// On l'enregistre notre objet $billet dans la base de données
				$em = $this->getDoctrine()->getManager();
				$em->persist($billet);
				$em->flush();
				// On définit un message flash
				$this->get('session')->getFlashBag()->add('info', 'Le billet a bien été modifié !');
				// On redirige vers la page de visualisation du billet nouvellement créé
				return $this->redirect($this->generateUrl('rwblog_view', array('id' => $billet->getId())));
			}
		}
		// À ce stade :
		// - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
		// - Soit la requête est de type POST, mais le formulaire n'est pas valide, donc on l'affiche de nouveau
		return $this->render('RwBlogBundle:Blog:edit.html.twig', array(
		'form' => $form->createView(),
		));
	}
}