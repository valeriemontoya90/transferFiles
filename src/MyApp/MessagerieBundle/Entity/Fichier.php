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
     * @ORM\Column(type="integer",length=255)
     * @Assert\NotBlank()
     */    
    private $poids;
    
    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     */    
    private $mimeType;
    
    /**
     * @ORM\Column(type="string",length=255)
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
     * @ORM\Column(type="integer",length=255)
     */
    private $messageId;
    
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

    /**
     * Set poids
     *
     * @param string $poids
     * @return Fichier
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;

        return $this;
    }

    /**
     * Get poids
     *
     * @return string 
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * Set mimeType
     *
     * @param string $mimeType
     * @return Fichier
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Get mimeType
     *
     * @return string 
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Set messageId
     *
     * @param integer $messageId
     * @return Fichier
     */
    public function setMessageId($messageId)
    {
        $this->messageId = $messageId;

        return $this;
    }

    /**
     * Get messageId
     *
     * @return integer 
     */
    public function getMessageId()
    {
        return $this->messageId;
    }



    /**
     * Set path
     *
     * @param string $path
     * @return Fichier
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

    /**
     * Set file
     *
     * @param \file $file
     * @return Fichier
     */
    public function setFile(\file $file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return \file 
     */
    public function getFile()
    {
        return $this->file;
    }

    public function upload() {
        // la propriété « file » peut être vide si le champ n'est pas requis
        if (null === $this->file) {
            return;
        }

        // utilisez le nom de fichier original ici mais
        // vous devriez « l'assainir » pour au moins éviter
        // quelconques problèmes de sécurité

        // la méthode « move » prend comme arguments le répertoire cible et
        // le nom de fichier cible où le fichier doit être déplacé
        $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());

        // définit la propriété « path » comme étant le nom de fichier où vous
        // avez stocké le fichier
        $this->path = $this->file->getClientOriginalName();
        var_dump($this->path);
        // « nettoie » la propriété « file » comme vous n'en aurez plus besoin
        $this->file = null;
    }
}
