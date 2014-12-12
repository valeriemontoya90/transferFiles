<?php
namespace MyApp\MessagerieBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
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
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     */
    private $corps;
    
    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min = "3")
     * @Assert\Null()
     */    
    private $motdePasse;

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
     * @Assert\File(maxSize="6000000")
     */
    public $file;
    
    /**
     * @ORM\Column(type="string", length=255)
     */

    public $path;

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
     * Set file
     *
     * @param $file
     * @return Message
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string 
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Message
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir().'/'.$this->path;
    }

    public function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }

    public function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'uploads/documents';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            // faites ce que vous voulez pour générer un nom unique
            $this->path = sha1(uniqid(mt_rand(), true)).'.'.$this->file->guessExtension();
            //$this->path = $this->file->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        // s'il y a une erreur lors du déplacement du fichier, une exception
        // va automatiquement être lancée par la méthode move(). Cela va empêcher
        // proprement l'entité d'être persistée dans la base de données si
        // erreur il y a
        $this->file->move($this->getUploadRootDir(), $this->path);

        unset($this->file);
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

    /**
     * Set motdePasse
     *
     * @param string $motdePasse
     * @return Message
     */
    public function setMotdePasse($motdePasse)
    {
        $this->motdePasse = $motdePasse;

        return $this;
    }

    /**
     * Get motdePasse
     *
     * @return string 
     */
    public function getMotdePasse()
    {
        return $this->motdePasse;
    }

    /**
     * Set corps
     *
     * @param string $corps
     * @return Message
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
}
