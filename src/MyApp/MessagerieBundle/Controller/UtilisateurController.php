<?php

namespace MyApp\MessagerieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use MyApp\MessagerieBundle\Entity\User;
use MyApp\MessagerieBundle\Entity\Message;
use MyApp\MessagerieBundle\Entity\Fichier;
use MyApp\MessagerieBundle\Entity\DestinataireInconnu;
use MyApp\MessagerieBundle\Form\UserForm;
use MyApp\MessagerieBundle\Form\MessageForm;
use MyApp\MessagerieBundle\Form\ConnexionForm;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response; 
//use Symfony\Component\BrowserKit\Response;

class UtilisateurController extends Controller
{
	
	public function indexAction() {
		return $this->container->get('templating')->renderResponse('MyAppMessagerieBundle:Utilisateur:index.html.twig');
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
        $destinataire_mail = "";
        $message = new Message();
        
        $em = $this->container->get('doctrine')->getEntityManager();
        $user = $em->getRepository('MyAppMessagerieBundle:User')->findOneBy(array('id' => $id));
        //var_dump($user);
        $expediteur_mail = $user->getMail();

        $form = $this->container
        	->get('form.factory')
        	->create(new MessageForm(), $message);
        //var_dump($message->setExpediteur($user));

        $request = $this->container->get('request');

        if ($request->getMethod() == 'POST') {
        	$form->bind($request);

        	if ($form->isValid()) {
                
        		$message->setExpediteur($user);
        		//$em = $this->container->get('doctrine')->getEntityManager();

        		$destinataire = $message->getDestinataire();
        		//var_dump($destinataire);
        		//var_dump($message->getDestinataire());
        		$destinataire_obj = $em->getRepository('MyAppMessagerieBundle:User')->findOneBy(array('mail' => $destinataire));
        		

        		//Si l'utilisateur est un membre
        		if ($destinataire_obj != null) {
        			$destinataire_mail = $destinataire_obj->getMail();
        			//var_dump($destinataire_id);
        			//$message->setDestinataire($destinataire_mail);
        			$message->setDestinataireInconnu(false);
        			$information = "destinataire connu";
        		} else {
        			//Si l'utilisateur n'est pas un membre.
        			$message->setDestinataireInconnu(true);
        			
        			//On le recherche parmi "les destinataires inconnus"
        			$destinataire_autres = $em->getRepository('MyAppMessagerieBundle:DestinataireInconnu')->findOneBy(array('mail' => $destinataire));
        			//var_dump($destinataire_autres);
        			if ($destinataire_autres != null) {
        				$destinataire_mail = $destinataire_autres->getMail();
        				//$message->setDestinataire($destinataire_mail);
        			} else {
        				//Si on ne le retrouve pas on l'enregistre dans la table "destinataire inconnu"
						$destinaireInconnu = new DestinataireInconnu();
						$destinaireInconnu->setMail($destinataire);
        				//$message->setDestinataire($destinataire_mail);
        				//$em->persist($message);
						$em->persist($destinaireInconnu);
						//$em->flush();
        			}
        		}

                $message->setDestinataire($destinataire_mail);
        		//Enregistrement d'une éventuelle pièce jointe
        		//var_dump($message->getFichier());
        		//$fichier_obj = $message->getFichier();
        		//var_dump($message->getFichier()->getSize());
        		$file = new Fichier();
        		$file->setNom($message->getFile()->getClientOriginalName());
        		$file->setPoids($message->getFile()->getSize());
        		$file->setMimeType($message->getFile()->getMimeType());
        		$file->setMotDePasse("");
        		$file->setPerennite("");
        		$file->setNbDeTelechargement("");
        		//$file_id = $em->getRepository('MyAppMessagerieBundle:Fichier')->findOneBy(array('nom' => $message->getFichier()->getClientOriginalName()));
				//$message->setFichier($file_id->getId());
                //$message->setFichierNom($file_id->getNom());


        		//Enregistrement du message
                //$message->upload(); Pas besoin
        		$em->persist($message);
        		$em->flush();

                $file->setMessageId($message->getId());
                //var_dump($file);
                $em->persist($file);
                $em->flush();

                // Envoi du mail

                // En-têtes additionnels
                // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
                
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $headers .= 'To: '. $destinataire_mail . "\r\n";
                $headers .= 'From: '. $expediteur_mail . "\r\n";
                //$headers .= 'Cc: anniversaire_archive@example.com' . "\r\n";
                //$headers .= 'Bcc: anniversaire_verif@example.com' . "\r\n";

                $to = $destinataire_mail;
                $subject = $message->getObjet();
                $message = "";
                mail($to, $subject, $message, $headers);
                
                //Fin envoi du mail

        		$information = "Message envoyé avec succès !";	
        	}
        }

        return $this->container->get('templating')
        	->renderResponse('MyAppMessagerieBundle:Utilisateur:message.html.twig',
        		array ('form' => $form->createView(), 'message' => $information, 'id' => $id)
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
        //var_dump($messages);
		return $this->container->get('templating')->renderResponse('MyAppMessagerieBundle:Utilisateur:listerrecus.html.twig',
		array('messages' => $messages, 'id' => $id)
		);
	}

    public function downloadAction($id, $path){
        $response = new Response();
        //$ok = "style.css";
        $response->headers->set('Content-type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'filename="'. $path);
        //$response->send() Pas besoin apparemment;
        //var_dump($response);
        return $response;
    }

    public function detailsmessagesAction($id, $message){
        $em = $this->container->get('doctrine')->getEntityManager();
        $detail = $em->getRepository('MyAppMessagerieBundle:Message')->findBy(array('id' => $message));
        //var_dump($messages->getExpediteur()->getMail());
        //var_dump($detail);
        return $this->container->get('templating')->renderResponse('MyAppMessagerieBundle:Utilisateur:detailsmessage.html.twig',
        array('message' => $detail, 'id' => $id)
        );
    }
}