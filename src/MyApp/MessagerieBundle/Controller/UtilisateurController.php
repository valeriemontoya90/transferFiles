<?php

namespace MyApp\MessagerieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use MyApp\MessagerieBundle\Entity\User;
use MyApp\MessagerieBundle\Entity\Message;
use MyApp\MessagerieBundle\Entity\DestinataireInconnu;
use MyApp\MessagerieBundle\Form\UserForm;
use MyApp\MessagerieBundle\Form\MessageForm;
use MyApp\MessagerieBundle\Form\ConnexionForm;

class UtilisateurController extends Controller
{
	
	public function indexAction() {
		$em = $this->container->get('doctrine')->getEntityManager();

		$users = $em->getRepository('MyAppMessagerieBundle:User')->findAll();

		$message = 'Users créés avec succès';

		return $this->container->get('templating')->renderResponse('MyAppMessagerieBundle:Utilisateur:index.html.twig',
		array('users' => $users, 'message' => $message)
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

        $message = new Message();
        
        $em = $this->container->get('doctrine')->getEntityManager();
        $user = $em->getRepository('MyAppMessagerieBundle:User')->findOneBy(array('id' => $id));
        //var_dump($user);

        $form = $this->container
        	->get('form.factory')
        	->create(new MessageForm(), $message);
        //var_dump($message->setExpediteur($user));

        $request = $this->container->get('request');

        if ($request->getMethod() == 'POST') {
        	$form->bind($request);

        	if ($form->isValid()) {
        		$message->setExpediteur($user);
        		$em = $this->container->get('doctrine')->getEntityManager();

        		$destinataire = $message->getDestinataire();
        		//var_dump($destinataire);
        		//var_dump($message->getDestinataire());
        		$destinataire_obj = $em->getRepository('MyAppMessagerieBundle:User')->findOneBy(array('mail' => $destinataire));
        		$destinataire_mail = "";
        		
        		if ($destinataire_obj != null) {
        			$destinataire_mail = $destinataire_obj->getMail();
        			//var_dump($destinataire_id);
        			$message->setDestinataire($destinataire_mail);
        			$message->setDestinataireInconnu(false);
        			$information = "destinataire connu";
        		} else {
        			$message->setDestinataireInconnu(true);
        			
        			//var_dump($destinataire);
        			$destinataire_autres = $em->getRepository('MyAppMessagerieBundle:DestinataireInconnu')->findOneBy(array('mail' => $destinataire));
        			//var_dump($destinataire_autres);
        			if ($destinataire_autres != null) {
        				$destinataire_mail = $destinataire_autres->getMail();
        				$message->setDestinataire($destinataire_mail);
        			} else {
						$destinaireInconnu = new DestinataireInconnu();
						$destinaireInconnu->setMail($destinataire);
        				$message->setDestinataire($destinataire_mail);
        				$em->persist($message);
						$em->persist($destinaireInconnu);
						$em->flush();
        			}
        		}

        		$em->persist($message);
        		$em->flush();
        		$information = "Message envoyé avec succès !";		
        	}
        }

        return $this->container->get('templating')
        	->renderResponse('MyAppMessagerieBundle:Utilisateur:message.html.twig',
        		array ('form' => $form->createView(), 'message' => $information)
        	);
    }

    public function listermessagesenvoyesAction($id) {
		$em = $this->container->get('doctrine')->getEntityManager();

		$envoyes = $em->getRepository('MyAppMessagerieBundle:Message')->findBy(array('expediteur' => $id));
		//var_dump($envoyes);

		return $this->container->get('templating')->renderResponse('MyAppMessagerieBundle:Utilisateur:listerenvoyes.html.twig',
		array('envoyes' => $envoyes, 'id' => $id)
		);
	}

    public function listermessagesrecusAction($id) {
		$em = $this->container->get('doctrine')->getEntityManager();

		$user = $em->getRepository('MyAppMessagerieBundle:User')->findOneBy(array('id' => $id));
		//var_dump($user);

		$messages = $em->getRepository('MyAppMessagerieBundle:Message')->findBy(array('destinataire' => $user->getMail()));
		//var_dump($messages->getExpediteur()->getMail());

		return $this->container->get('templating')->renderResponse('MyAppMessagerieBundle:Utilisateur:listerrecus.html.twig',
		array('messages' => $messages, 'id' => $id)
		);
	}
}