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
    private $source;
    private $files;
    private $extension_upload;

    public function __construct($array, $files)
    {
        $this->photo = new photo($array);
        $this->files = $files;
        $this->setExtensionupload();
        $this->setsource();
    }

    public function exif()
    {
        $exif = exif_read_data($this->files['fichier']['tmp_name'], 'EXIF', true);
        if ($this->extension_upload == 'jpg' || $this->extension_upload == 'jpeg') {
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
        $this->photo->setExtension($this->extension_upload);
    }

    public function creerImagesource()
    {
        $imageCreateFrom = array(
            "jpg" => "imagecreatefromjpeg",
            "png" => "imagecreatefrompng"
        );

        // Récupération de l'extention du fichier
        $extention = $this->extension_upload;
        $extention = ($extention == "jpeg") ? "jpg" : $extention;
        $function = $imageCreateFrom[$extention];
        $image_source = $function($this->source);
        // Sauvegarde de la transparence de l'image
        imagealphablending($image_source, false);
        imagesavealpha($image_source, true);

        return $image_source;
    }

    function creerImage($image, $destination, $quality = 50)
    {
        $imageCreate = array(
            "jpeg" => "imagejpeg",
            "jpg" => "imagejpeg",
            "png" => "imagepng"
        );

        // Récupération de l'extention du fichier
        $extention = pathinfo($destination, PATHINFO_EXTENSION);
        $extention = strtolower($extention);

        $function = $imageCreate[$extention];

        if ($extention == "jpg") {
            $function($image, $destination, $quality);
        } else {
            $function($image, $destination);
        }

        imagedestroy($image);
    }

    function redimensionneImage($destination, $width, $height)
    {
        $image_source = $this->creerImagesource();
        $size = getimagesize($this->source);
        if ($width == -1 || $height == -1) { // Si valeur automatique
            // On remplace le -1 par la valeur calculée
            $height = ($width != -1 && $height == -1) ?
                    (($size[1] * $width) / $size[0]) : $height;
            $width = ($width == -1 && $height != -1) ?
                    (($size[0] * $height) / $size[1]) : $width;
        } else if ($size[0] < $size[1]) { // Si portrait
            $tmp = $height;
            $height = $width;
            $width = $tmp;
        }
        $image_redim = imagecreatetruecolor($width, $height);
        imagealphablending($image_redim, false);
        imagesavealpha($image_redim, true);
        imagecopyresampled($image_redim, $image_source, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
        imagedestroy($image_source);
        $this->creerImage($image_redim, $destination);
    }

    public function enregistrePhoto()
    {
        $extension = $this->photo->getExtension();
        $chemin_miniature = "./img/img_utilisateur/miniature/";
        $nom_miniature = $chemin_miniature . $this->photo->getNom_photo() . '.' . $extension;
        $resultat = move_uploaded_file($this->files['fichier']['tmp_name'], $this->source);
        $this->redimensionneImage($nom_miniature, 250, -1);
    }

    public function ajoutphoto()
    {
        $this->exif();
        if ($this->photo->isValid()) {
            $this->enregistrePhoto();
        }
        return $this->photo;
    }

    //setter//
    public function setSource()
    {
        $this->source = "./img/img_utilisateur/taille_normal/" . $this->photo->getNom_photo() . '.' . $this->extension_upload;
    }

    public function setExtensionupload()
    {
        $infosfichier = pathinfo($this->files['fichier']['name']);
        $this->extension_upload = strtolower($infosfichier['extension']);
    }

}
