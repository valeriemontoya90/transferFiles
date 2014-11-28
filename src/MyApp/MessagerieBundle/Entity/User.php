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
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     */    
    private $mail;
    
    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     */    
    private $motDePasse;
    
    /**
     * @ORM\Column(type="integer",length=255)
     */    
    private $tailleMaxFichier;
    
    /**
     * @ORM\Column(type="integer",length=255)
     */    
    private $nbFilleuil;

    /**
     * @ORM\Column(type="boolean")
     */    
    private $estInconnu;

    /**
     * @ORM\ManyToMany(targetEntity="Fichier")
     */    
    private $fichier;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tailleMaxFichier = 0;
        $this->nbFilleuil = 0;
        $this->fichier = new \Doctrine\Common\Collections\ArrayCollection();
        $this->destinataireInconnu = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return User
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
     * Set prenom
     *
     * @param string $prenom
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return User
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set motDePasse
     *
     * @param string $motDePasse
     * @return User
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
     * Set tailleMaxFichier
     *
     * @param integer $tailleMaxFichier
     * @return User
     */
    public function setTailleMaxFichier($tailleMaxFichier)
    {
        $this->tailleMaxFichier = $tailleMaxFichier;

        return $this;
    }

    /**
     * Get tailleMaxFichier
     *
     * @return integer 
     */
    public function getTailleMaxFichier()
    {
        return $this->tailleMaxFichier;
    }

    /**
     * Set nbFilleuil
     *
     * @param integer $nbFilleuil
     * @return User
     */
    public function setNbFilleuil($nbFilleuil)
    {
        $this->nbFilleuil = $nbFilleuil;

        return $this;
    }

    /**
     * Get nbFilleuil
     *
     * @return integer 
     */
    public function getNbFilleuil()
    {
        return $this->nbFilleuil;
    }

    /**
     * Set message
     *
     * @param \MyApp\MessagerieBundle\Entity\Message $message
     * @return User
     */
    public function setMessage(\MyApp\MessagerieBundle\Entity\Message $message = null)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return \MyApp\MessagerieBundle\Entity\Message 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Add fichier
     *
     * @param \MyApp\MessagerieBundle\Entity\Fichier $fichier
     * @return User
     */
    public function addFichier(\MyApp\MessagerieBundle\Entity\Fichier $fichier)
    {
        $this->fichier[] = $fichier;

        return $this;
    }

    /**
     * Remove fichier
     *
     * @param \MyApp\MessagerieBundle\Entity\Fichier $fichier
     */
    public function removeFichier(\MyApp\MessagerieBundle\Entity\Fichier $fichier)
    {
        $this->fichier->removeElement($fichier);
    }

    /**
     * Get fichier
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFichier()
    {
        return $this->fichier;
    }

    /**
     * Add destinataireInconnu
     *
     * @param \MyApp\MessagerieBundle\Entity\DestinataireInconnu $destinataireInconnu
     * @return User
     */
    public function addDestinataireInconnu(\MyApp\MessagerieBundle\Entity\DestinataireInconnu $destinataireInconnu)
    {
        $this->destinataireInconnu[] = $destinataireInconnu;

        return $this;
    }

    /**
     * Remove destinataireInconnu
     *
     * @param \MyApp\MessagerieBundle\Entity\DestinataireInconnu $destinataireInconnu
     */
    public function removeDestinataireInconnu(\MyApp\MessagerieBundle\Entity\DestinataireInconnu $destinataireInconnu)
    {
        $this->destinataireInconnu->removeElement($destinataireInconnu);
    }

    /**
     * Get destinataireInconnu
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDestinataireInconnu()
    {
        return $this->destinataireInconnu;
    }

    /**
     * Set estInconnu
     *
     * @param boolean $estInconnu
     * @return User
     */
    public function setEstInconnu($estInconnu)
    {
        $this->estInconnu = $estInconnu;

        return $this;
    }

    /**
     * Get estInconnu
     *
     * @return boolean 
     */
    public function getEstInconnu()
    {
        return $this->estInconnu;
    }
}
