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

    public function __construct($array, $files,$source)
    {
        $this->photo = new photo($array);
        $this->files = $files;
        $this->setExtensionupload();
        $this->setsource($source);
    }

    /**
     * ajoute les données exif si elles existent à une photo 
     * @param null
     * @return null
     */
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

    /**
     * Retourne un identifiant d'image représentant une image obtenue
     * à partir du fichier source
     * @param null
     * @return null
     */
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

    /**
     * Créer un fichier JPEG / PNG depuis l'image fournie
     * 
     * @param $image Une ressource d'image, retournée par 
     * une des fonctions de création d'images
     * 
     * @param $destination Le chemin d'enregistrement du fichier. 
     * S'il n'est pas défini ou vaut NULL, le flux d'image brute 
     * sera affiché directement.
     * 
     * @param $quality Quality est optionnel, et prend des valeurs
     * entières de 0 (pire qualité, petit fichier) et 
     * 100 (meilleure qualité, gros fichier). 
     * Par défaut, la valeur est 50
     * 
     * @return null
     * */
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

    /**
     * Redimensionne une image
     * 
     * @param $destination Chemin de destination de l'image 
     * redimensionnée
     * 
     * @param $width Width de l'image redimensionnée (largeur)
     * 
     * @param $height Height de l'image redimensionnée (hauteur)
     * 
     * @param $quality Quality de l'image redimensionnée (compression) 
     * si jpeg
     * @return null
     */
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

    /**
     * enregistre une photo sur le serveur ainsi qu'une miniature
     * 
     * @return null
     */
    public function enregistrePhoto($chemin_miniature)
    {
        $extension = $this->photo->getExtension();
        $nom_miniature = $chemin_miniature . $this->photo->getNom_photo() . '.' . $extension;
        $resultat = move_uploaded_file($this->files['fichier']['tmp_name'], $this->source);
        $this->redimensionneImage($nom_miniature, 250, -1);
    }
    
    
     /**
     * execute exif et enregistrePhoto
     * 
     * @return null
     */
    public function ajoutphoto($chemin_miniature)
    {
        $this->exif();
        if ($this->photo->isValid()) {
            $this->enregistrePhoto($chemin_miniature);
        }
        return $this->photo;
    }

    //setter//
    public function setSource($source)
    {
        $this->source =$source . $this->photo->getNom_photo() . '.' . $this->extension_upload;
    }

    public function setExtensionupload()
    {
        $infosfichier = pathinfo($this->files['fichier']['name']);
        $this->extension_upload = strtolower($infosfichier['extension']);
    }

}
