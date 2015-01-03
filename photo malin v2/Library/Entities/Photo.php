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
class photo extends \Library\Entity
{

    private $auteur;
    private $nom_photo;
    private $titre;
    private $commentaire;
    private $extension;
    private $privee;
    private $appareil_photo;
    private $date_prise_photo;
    private $iso;
    private $vit_obt;
    private $focale;

    const AUTEUR_INVALIDE = 1;
    const NOM_PHOTO_INVALIDE = 2;
    const TITRE_INVALIDE = 3;
    const COMMENTAIRE_INVALIDE = 4;
    const EXTENSION_INVALIDE = 5;
    const EXTENSION_NON_SUPPORTE = 6;
    const PRIVEE_INVALIDE = 7;
    const APPAREIL_PHOTO_INVALIDE = 8;
    const VIT_OBT_INVALIDE = 9;
    const ISO_INVALIDE = 10;
    const FOCALE_INVALIDE = 11;


    public function isValid()
    {
        return !(empty($this->auteur) || empty($this->titre) || empty($this->nom_photo) || empty($this->extension) || empty($this->privee));
    }

    public function __construct(array $donnees = array())
    {
        parent::__construct($donnees);
        $this->setNom_photo();
    }

    public function setAuteur($auteur)
    {
        if (!is_string($auteur) || empty($auteur)) {
            $this->erreurs[] = self::AUTEUR_INVALIDE;
        } else {
            $this->auteur = $auteur;
        }
    }

    public function setNom_photo()
    {
            $this->nom_photo=md5(uniqid($this->getauteur(),true));        
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

    public function setExtension($extension)
    {
        $extensions_valides = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
        if (!is_string($extension) || empty($extension)) {
            $this->erreurs[] = self::EXTENSION_INVALIDE;
        } else if (!in_array($extension, $extensions_valides)) {
            $this->erreurs[] = self::EXTENSION_NON_SUPPORTE;
        } else {
            $this->extension = $extension;
        }
    }

    public function setPrivee($privee)
    {
        if (!is_string($privee) || empty($privee)) {
            $this->erreurs[] = self::PRIVEE_INVALIDE;
        } else if($privee == 'privee' || $privee !== 'public') {
            $this->privee = $privee;
        } else {
            $this->erreurs[] = self::PRIVEE_INVALIDE;
        }
    }

    public function setAppareil_photo($appareil_photo)
    {
        if (!is_string($appareil_photo) || empty($appareil_photo)) {
            $this->erreurs[] = self::APPAREIL_PHOTO_INVALIDE;
        } else {
            $this->appareil_photo = $appareil_photo;
        }
    }

    public function setDate_prise_photo($date_prise_photo)
    {
        $this->date_prise_photo = $date_prise_photo;
    }

    public function setIso($iso)
    {
        if (!is_int($iso) || empty($iso)) {
            $this->erreurs[] = self::ISO_INVALIDE;
        } else {
            $this->iso = $iso;
        }
    }

    public function setVit_obt($vit_obt)
    {
        if (!is_string($vit_obt) || empty($vit_obt)) {
            $this->erreurs[] = self::VIT_OBT_INVALIDE;
        } else {
            $this->vit_obt = $vit_obt;
        }
    }

    public function setFocale($focale)
    {
        if (!is_string($focale) || empty($focale)) {
            $this->erreurs[] = self::FOCALE_INVALIDE;
        } else {
            $focale=round($focale,0);
            $this->focale = $focale . ' mm';
        }
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

    public function getNom_photo()
    {
        return $this->nom_photo;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getCommentaire()
    {
        return $this->commentaire;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function getPrivee()
    {
        return $this->privee;
    }

    public function getAppareil_photo()
    {
        return $this->appareil_photo;
    }

    public function getDate_prise_photo()
    {
        return $this->date_prise_photo;
    }

    public function getIso()
    {
        return $this->iso;
    }

    public function getVit_obt()
    {
        return $this->vit_obt;
    }

    public function getFocale()
    {
        return $this->focale;
    }

}
