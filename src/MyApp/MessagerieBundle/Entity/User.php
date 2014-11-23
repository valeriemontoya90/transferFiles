<?php
namespace MyApp\MessagerieBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class User 
{
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string",length="255")
     * @Assert\NotBlank()
     * @Assert\MinLength(3)
     */    
    private $nom;
    
    /**
     * @ORM\Column(type="string",length="255")
     * @Assert\NotBlank()
     * @Assert\MinLength(3)
     */    
    private $prenom;
    
    /**
     * @ORM\Column(type="string",length="255")
     * @Assert\NotBlank()
     * @Assert\MinLength(3)
     */    
    private $mail;
    
    /**
     * @ORM\Column(type="string",length="255")
     * @Assert\NotBlank()
     * @Assert\MinLength(3)
     */    
    private $motDePasse;
    
    /**
     * @ORM\Column(type="integer",length="255")
     * @Assert\NotBlank()
     */    
    private $tailleMaxFichier;
    
    /**
     * @ORM\Column(type="integer",length="255")
     */    
    private $nbFilleuil;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Message")
     */    
    private $message;

    /**
     * @ORM\ManyToMany(targetEntity="Fichier")
     */    
    private $fichier;
    
    /**
     * @ORM\ManyToMany(targetEntity="DestinataireInconnu")
     */    
    private $destinataireInconnu;
}
