<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Library\Entities;

/**
 * Description of Comment
 *
 * @author jeang
 */
class Comment extends \Library\Entity {

    protected $news,
            $auteur,
            $contenu,
            $date;

    const AUTEUR_INVALIDE = 1;
    const CONTENU_INVALIDE = 2;
    const AUTEUR_TROP_LONG = 3;
    const CONTENU_TROP_LONG = 4;
    
    public function isValid() {
        return !(empty($this->auteur) || empty($this->contenu));
    }

    // SETTERS

    public function setNews($news) {
        $this->news = (int) $news;
    }

    public function setAuteur($auteur) {
        if (!is_string($auteur) || empty($auteur)) {
            $this->erreurs[] = self::AUTEUR_INVALIDE;
        } 
         else if (strlen($auteur) > 20)
        {
             $this->erreurs[] = self::AUTEUR_TROP_LONG;
        }
        else {
            $this->auteur = $auteur;
        }
    }

    public function setContenu($contenu) {
        if (!is_string($contenu) || empty($contenu)) {
            $this->erreurs[] = self::CONTENU_INVALIDE;
        }
        else if (strlen($contenu) > 1200)
        {
             $this->erreurs[] = self::CONTENU_TROP_LONG;
        }
        else {
            $this->contenu = $contenu;
        }
    }

    public function setDate(\DateTime $date) {
        $this->date = $date;
    }

    // GETTERS

    public function news() {
        return $this->news;
    }

    public function auteur() {
        return $this->auteur;
    }

    public function contenu() {
        return $this->contenu;
    }

    public function date() {
        return $this->date;
    }

}
