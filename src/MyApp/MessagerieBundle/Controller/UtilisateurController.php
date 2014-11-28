<?php

namespace MyApp\MessagerieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use MyApp\MessagerieBundle\Entity\User;
use MyApp\MessagerieBundle\Entity\Message;
use MyApp\MessagerieBundle\Form\UserForm;
use MyApp\MessagerieBundle\Form\MessageForm;
use MyApp\MessagerieBundle\Form\ConnexionForm;

class UtilisateurController extends Controller
{
	
	public function indexAction() {
		$em = $this->container->get('doctrine')->getEntityManager();

		$User1 = new User();
		$User1->setNom('Swan');
		$User1->setPrenom('Emma');
		$User1->setMotDePasse('roy');
		$User1->setMail('emma.swan@test.com');
		$User1->setTailleMaxFichier('20');
		$User1->setNbFilleuil('50');
		$em->persist($User1);

		$User2 = new User();
		$User2->setNom('FilsDeGold');
		$User2->setPrenom('Nil');
		$User2->setMotDePasse('roy2');
		$User2->setMail('nil.filsdegold@test.com');
		$User2->setTailleMaxFichier('50');
		$User2->setNbFilleuil('50');
		$em->persist($User2);

		//$em->flush();

		$users = $em->getRepository('MyAppMessagerieBundle:User')->findAll();

		$message = 'Users créés avec succès';

		return $this->container->get('templating')->renderResponse('MyAppMessagerieBundle:Utilisateur:index.html.twig',
		array('users' => $users)
		);
	}

    public function ajouterAction() {
    	$message = '';

        $utilisateur = new User();

        $form = $this->container
        	->get('form.factory')
        	->create(new UserForm(), $utilisateur);

        $request = $this->container->get('request');

        if ($request->getMethod() == 'POST') {
        	$form->bind($request);

        	if ($form->isValid()) {
        		$em = $this->container->get('doctrine')->getEntityManager();
        		$em->persist($utilisateur);
        		$em->flush();
        		$message = "Votre inscription a fonctionné avec succès !";		
        	} else {
        		$message = "Formulaire invalide !";
        	}

        }

        return $this->container->get('templating')
        	->renderResponse('MyAppMessagerieBundle:Utilisateur:ajouter.html.twig',
        		array ('form' => $form->createView(), 'message' => $message)
        	);
    }

    public function connecterAction() {
    	$message = '';
    	$user = 0;
        $utilisateur = new User();
        
        $form = $this->container
        	->get('form.factory')
        	->create(new ConnexionForm(), $utilisateur);

        $request = $this->container->get('request');
        $em = $this->container->get('doctrine')->getEntityManager();

        if ($request->getMethod() == 'POST') {
        	$form->bind($request);

        	if ($form->isValid()) {
        		$user_exists = $em->getRepository('MyAppMessagerieBundle:User')->findOneBy(
					array('mail' => $utilisateur->getMail()));
        		//var_dump($user_exists);
				if ($user_exists != null) {
					$user = $user_exists->getId();
					$message = "Utilisateur connu";
					//return new RedirectResponse($this->container->get('router')->generate('my_app_messagerie_envoyer'));
					//$url = $this->generateUrl('blog_show', array('slug' => 'my-blog-post'));
				} else {
					$message = "Utilisateur inconnu";
				}
        	} else {
        		$message = "Formulaire invalide";
        	}
        }

        return $this->container->get('templating')
        	->renderResponse('MyAppMessagerieBundle:Utilisateur:connecter.html.twig',
        		array ('form' => $form->createView(), 'message' => $message, 'user' => $user)
        	);
    }

    public function envoyerAction($id = null) {
    	$information = '';

        $messag = new Message();
        
        $em = $this->container->get('doctrine')->getEntityManager();
        $user = $em->getRepository('MyAppMessagerieBundle:User')->findOneBy(array('id' => $id));

        $form = $this->container
        	->get('form.factory')
        	->create(new MessageForm(), $messag);

        $request = $this->container->get('request');

        if ($request->getMethod() == 'POST') {
        	$form->bind($request);

        	if ($form->isValid()) {
        		$messag->setUser($user);
        		$em = $this->container->get('doctrine')->getEntityManager();

        		$em->persist($messag);
        		$em->flush();
        		$information = "Message envoyé avec succès !";		
        	}

        }

        return $this->container->get('templating')
        	->renderResponse('MyAppMessagerieBundle:Utilisateur:message.html.twig',
        		array ('form' => $form->createView(), 'message' => $information)
        	);
    }
}