<?php
namespace MyApp\MessagerieBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Message 
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
    private $objet;
    
    /**
     * @ORM\Column(type="text")
     */    
    private $contenu;

    /**
     * @ORM\ManyToOne(targetEntity="MyApp\MessagerieBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $expediteur;

    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     */
    private $destinataire;

    /**
     * @ORM\Column(type="boolean")
     */    
    private $destinataireInconnu;

    /**
     * @ORM\Column(type="integer",length=255)
     */    
    private $fichier;

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
     * Set objet
     *
     * @param string $objet
     * @return Message
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;

        return $this;
    }

    /**
     * Get objet
     *
     * @return string 
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return Message
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set user
     *
     * @param \MyApp\MessagerieBundle\Entity\User $user
     * @return Message
     */
    public function setExpediteur(\MyApp\MessagerieBundle\Entity\User $expediteur)
    {
        $this->expediteur = $expediteur;

        return $this;
    }

    /**
     * Get user
     *
     * @return \MyApp\MessagerieBundle\Entity\User 
     */
    public function getExpediteur()
    {
        return $this->expediteur;
    }

    /**
     * Set destinataire
     *
     * @param string $destinataire
     * @return Message
     */
    public function setDestinataire($destinataire)
    {
        $this->destinataire = $destinataire;

        return $this;
    }

    /**
     * Get destinataire
     *
     * @return string 
     */
    public function getDestinataire()
    {
        return $this->destinataire;
    }

    /**
     * Set destinataireInconnu
     *
     * @param boolean $destinataireInconnu
     * @return Message
     */
    public function setDestinataireInconnu($destinataireInconnu)
    {
        $this->destinataireInconnu = $destinataireInconnu;

        return $this;
    }

    /**
     * Get destinataireInconnu
     *
     * @return boolean 
     */
    public function getDestinataireInconnu()
    {
        return $this->destinataireInconnu;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->destinataire = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add destinataire
     *
     * @param \MyApp\MessagerieBundle\Entity\User $destinataire
     * @return Message
     */
    public function addDestinataire(\MyApp\MessagerieBundle\Entity\User $destinataire)
    {
        $this->destinataire[] = $destinataire;

        return $this;
    }

    /**
     * Remove destinataire
     *
     * @param \MyApp\MessagerieBundle\Entity\User $destinataire
     */
    public function removeDestinataire(\MyApp\MessagerieBundle\Entity\User $destinataire)
    {
        $this->destinataire->removeElement($destinataire);
    }

    /**
     * Set fichier
     *
     * @param string $fichier
     * @return Message
     */
    public function setFichier($fichier)
    {
        $this->fichier = $fichier;

        return $this;
    }

    /**
     * Get fichier
     *
     * @return string 
     */
    public function getFichier()
    {
        return $this->fichier;
    }
}
