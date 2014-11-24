<?php

namespace MyApp\MessagerieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyApp\MessagerieBundle\Entity\User;

class DefaultController extends Controller
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

		$em->flush();

		$message = 'Catégories créées avec succès';

		return $this->container->get('templating')->renderResponse('MyAppMessagerieBundle:Default:index.html.twig',
		array('message' => $message)
		);
	}

    public function editAction()
    {
        return $this->render('MyAppMessagerieBundle:Default:edit.html.twig');
    }
}