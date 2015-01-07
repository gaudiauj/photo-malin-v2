<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Library\Entities;

/**
 * Description of photo
 *
 * @author jeang
 */
/**
 * Class photo
 * @package Library\Entities
 */
class photo extends image
{

    private $auteur;    
    private $titre;
    private $commentaire;    
    private $privee;
    private $exif;
    

    const AUTEUR_INVALIDE = 1;
    const TITRE_INVALIDE = 3;
    const COMMENTAIRE_INVALIDE = 4;
    const PRIVEE_INVALIDE = 7;


    /**
     * defini si l'objet est valide ou non
     * @return bool
     */
    public function isValid()
    {        
        return !(empty($this->auteur) || empty($this->titre) || empty($this->nom_photo) || empty($this->extension) || empty($this->privee));
    }

    /**
     * @param array $donnees
     */
    public function __construct(array $donnees = array())
    {
        parent::__construct($donnees);
        $this->setExif($donnees);
    }

    /**
     * @param $auteur
     */
    public function setAuteur($auteur)
    {
        if (!is_string($auteur) || empty($auteur)) {
            $this->erreurs[] = self::AUTEUR_INVALIDE;
        } else {
            $this->auteur = $auteur;
        }
    }

    /**
     * @param $titre
     */
    public function setTitre($titre)
    {
        if (!is_string($titre) || empty($titre)) {
            $this->erreurs[] = self::TITRE_INVALIDE;
        } else {
            $this->titre = $titre;
        }
    }

    /**
     * @param $commentaire
     */
    public function setCommentaire($commentaire)
    {
        if (!is_string($commentaire) || empty($commentaire)) {
            $this->erreurs[] = self::COMMENTAIRE_INVALIDE;
        } else {
            $this->commentaire = $commentaire;
        }
    }

    /**
     * @param $privee
     */
    public function setPrivee($privee)
    {
        if (!is_string($privee) || empty($privee)) {
            $this->erreurs[] = self::PRIVEE_INVALIDE;
        } else if($privee == 'privee' || $privee == 'public') {
            $this->privee = $privee;
        } else {
            $this->erreurs[] = self::PRIVEE_INVALIDE;
        }
    }

    /**
     * @param array $donnees
     */
    public function setExif(array $donnees = array())
    {
        $this->exif= new exif($donnees);
        $this->erreurs=array_merge($this->erreurs,$this->exif->erreurs);
    }

    //getter//


    /**
     * @return mixed
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @return mixed
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * @return mixed
     */
    public function getPrivee()
    {
        return $this->privee;
    }

    /**
     * @return mixed
     */
    public function getExif()
    {
        return $this->exif;
    }



}
