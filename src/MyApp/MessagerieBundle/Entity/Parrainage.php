<?php
namespace MyApp\MessagerieBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Parrainage {
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
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     */
    private $corps;

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
     * @return Parrainage
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
     * Set corps
     *
     * @param string $corps
     * @return Parrainage
     */
    public function setCorps($corps)
    {
        $this->corps = $corps;

        return $this;
    }

    /**
     * Get corps
     *
     * @return string 
     */
    public function getCorps()
    {
        return $this->corps;
    }

    /**
     * Set destinataire
     *
     * @param string $destinataire
     * @return Parrainage
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
     * @return Parrainage
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
     * Set expediteur
     *
     * @param \MyApp\MessagerieBundle\Entity\User $expediteur
     * @return Parrainage
     */
    public function setExpediteur(\MyApp\MessagerieBundle\Entity\User $expediteur)
    {
        $this->expediteur = $expediteur;

        return $this;
    }

    /**
     * Get expediteur
     *
     * @return \MyApp\MessagerieBundle\Entity\User 
     */
    public function getExpediteur()
    {
        return $this->expediteur;
    }
}
