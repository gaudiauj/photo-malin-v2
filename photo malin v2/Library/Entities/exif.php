<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Library\Entities;

/**
 * Description of exif
 *
 * @author jeang
 */
class exif extends \Library\Entity
{

    private $appareil_photo;
    private $date_prise_photo;
    private $iso;
    private $vit_obt;
    private $focale;
    
    
    const APPAREIL_PHOTO_INVALIDE = 8;
    const VIT_OBT_INVALIDE = 9;
    const ISO_INVALIDE = 10;
    const FOCALE_INVALIDE = 11;
    // setter ///
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
            $focale = round($focale, 0);
            $this->focale = $focale . ' mm';
        }
    }

    //getter//
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
