<?php

namespace MyApp\MessagerieBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Fichier 
{
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     */    
    private $nom;
    
    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min=3)
     */    
    private $motDePasse;
    
    /**
     * @ORM\Column(type="string",length=255)
     */    
    private $perennite;
    
    /**
     * @ORM\Column(type="integer",length=255)
     */    
    private $nbDeTelechargement;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Fichier
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set motDePasse
     *
     * @param string $motDePasse
     * @return Fichier
     */
    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    /**
     * Get motDePasse
     *
     * @return string 
     */
    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    /**
     * Set perennite
     *
     * @param string $perennite
     * @return Fichier
     */
    public function setPerennite($perennite)
    {
        $this->perennite = $perennite;

        return $this;
    }

    /**
     * Get perennite
     *
     * @return string 
     */
    public function getPerennite()
    {
        return $this->perennite;
    }

    /**
     * Set nbDeTelechargement
     *
     * @param integer $nbDeTelechargement
     * @return Fichier
     */
    public function setNbDeTelechargement($nbDeTelechargement)
    {
        $this->nbDeTelechargement = $nbDeTelechargement;

        return $this;
    }

    /**
     * Get nbDeTelechargement
     *
     * @return integer 
     */
    public function getNbDeTelechargement()
    {
        return $this->nbDeTelechargement;
    }
}
