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
    


    public function isValid()
    {        
        return !(empty($this->auteur) || empty($this->titre) || empty($this->nom_photo) || empty($this->extension) || empty($this->privee));
    }

    public function __construct(array $donnees = array())
    {
        parent::__construct($donnees);
        $this->setExif($donnees);
    }

    public function setAuteur($auteur)
    {
        if (!is_string($auteur) || empty($auteur)) {
            $this->erreurs[] = self::AUTEUR_INVALIDE;
        } else {
            $this->auteur = $auteur;
        }
    }
    
    public function setTitre($titre)
    {
        if (!is_string($titre) || empty($titre)) {
            $this->erreurs[] = self::TITRE_INVALIDE;
        } else {
            $this->titre = $titre;
        }
    }

    public function setCommentaire($commentaire)
    {
        if (!is_string($commentaire) || empty($commentaire)) {
            $this->erreurs[] = self::COMMENTAIRE_INVALIDE;
        } else {
            $this->commentaire = $commentaire;
        }
    }

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
    
    public function setExif(array $donnees = array())
    {
        $this->exif= new exif($donnees);
        $this->erreurs=array_merge($this->erreurs,$this->exif->erreurs);
    }

    //getter//


    public function getAuteur()
    {
        return $this->auteur;
    }

    public function getPhotographe()
    {
        return $this->photographe;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getCommentaire()
    {
        return $this->commentaire;
    }
    
    public function getPrivee()
    {
        return $this->privee;
    }
    
    public function getExif()
    {
        return $this->exif;
    }



}
