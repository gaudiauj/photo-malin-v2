<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Applications\Frontend\Modules\photo;

use Library\Entities\photo;

/**
 * Description of PhotoClass
 *
 * @author jeang
 */
class PhotoClass
{

    private $photo;

    public function __construct($array)
    {
        $this->photo = new photo($array);
    }

    public function exif($extension_upload, $files)
    {
        $exif = exif_read_data($files['fichier']['tmp_name'],'EXIF', true);
        if ($extension_upload == 'jpg' || $extension_upload == 'jpeg') {
            if ($exif) { // Si le fichier $img contient des infos Exif
                foreach ($exif as $key => $section) // On parcourt la première partie du tableau multidimensionnel
                {
                    foreach ($section as $name => $value) // On parcourt la seconde partie
                    {
                        $exif_tab[$name] = $value; // Récupération des valeurs dans le tableau $exif_tab
                    }
                }
                if (isset($exif_tab['Model'])) {
                    $this->photo->setAppareil_photo($exif_tab['Model']);
                }
                //iso
                if (isset($exif_tab['ISOSpeedRatings'])) {
                    $this->photo->setIso($exif_tab['ISOSpeedRatings']);
                }
                //date de prise de la photo
                if (isset($exif_tab['DateTimeOriginal'])) {
                    $this->photo->setDate_prise_photo($exif_tab['DateTimeOriginal']);
                }
                // Vitesse d'obturation
                if (isset($exif_tab['ExposureTime'])) {
                    $this->photo->setVit_obt($exif_tab['ExposureTime']);
                }
                if (isset($exif_tab['FocalLength'])) {
                    $this->photo->setFocale($exif_tab['FocalLength']);
                }
            }
        }
        $this->photo->setExtension($extension_upload);
        var_dump($this->photo);
        if ($this->photo->isValid()) {
            return $this->photo;
        } else {
            return $this->photo;
        }
    }

}
