<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Library\Entities;

/**
 * Description of image
 *
 * @author jeang
 */
class image extends \Library\Entity
{

    protected $nom_photo;
    protected $extension;
    private static $extensions_valides = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');

    const NOM_PHOTO_INVALIDE = 2;
    const EXTENSION_INVALIDE = 5;
    const EXTENSION_NON_SUPPORTE = 6;

    public function isValid()
    {
        return !(empty($this->nom_photo) || empty($this->extension));
    }

    public function __construct(array $donnees = array())
    {
        parent::__construct($donnees);
        $this->setNom_photo();
    }

    //setter //
    public function setNom_photo()
    {
        $this->nom_photo = md5(uniqid($this->getauteur(), true));
    }

    public function setExtension($extension)
    {
        if (!is_string($extension) || empty($extension)) {
            $this->erreurs[] = self::EXTENSION_INVALIDE;
        } else if (!in_array($extension, self::$extensions_valides)) {
            $this->erreurs[] = self::EXTENSION_NON_SUPPORTE;
        } else {
            $this->extension = $extension;
        }
    }

    //getter//

    public function getExtension()
    {
        return $this->extension;
    }

    public function getNom_photo()
    {
        return $this->nom_photo;
    }

}
