<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Library\Entities;

/**
 * Description of membre
 *
 * @author jeang
 */
class Membre extends \Library\Entity {

    protected $pseudo;
    protected $pass;
    protected $mail;
    protected $dateInscription;

    const PSEUDO_INVALIDE = 1;
    const PSEUDO_TROP_LONG = 2;
    const MDP_INVALIDE = 3;
    const MDP_TROP_COURT = 4;
    const MAIL_INVALIDE = 5;
    const PSEUDO_CARACTERE_SPECIAUX = 6;

    
        public function isValid() {
        return !(empty($this->pseudo) || empty($this->mail) || empty($this->pass));
    }

    // SETTERS
    public function setPseudo($pseudo) {
        if (!is_string($pseudo) || empty($pseudo)) {
            $this->erreurs[] = self::PSEUDO_INVALIDE;
        } else if (strlen($pseudo) > 20) {
            $this->erreurs[] = self::PSEUDO_TROP_LONG;
        }
        else if (!preg_match("#^[\w \-]+$#", $pseudo))
        {
            $this->erreurs[] = self::PSEUDO_CARACTERE_SPECIAUX;
        }
        else {
            $this->pseudo = $pseudo;
        }
    }

    public function setPass($pass) {
        if (!is_string($pass) || empty($pass)) {
            $this->erreurs[] = self::MDP_INVALIDE;
        } else if (strlen($pass) < 6) {
            $this->erreurs[] = self::MDP_TROP_COURT;
        } else {
            $pass = sha1($pass);
            $this->pass = $pass;
        }
    }

    public function setMail($mail) {
        if (!is_string($mail) || empty($mail) || !preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $mail)) {
            $this->erreurs[] = self::MAIL_INVALIDE;
        } else {
            $this->mail = $mail;
        }
    }

    public function setDateInscription(\DateTime $dateInscription) {
        $this->dateInscription = $dateInscription;
    }

    //GETTER
    public function getPseudo() {
        return $this->pseudo;
    }

    public function getPass() {
        return $this->pass;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getDateInscription() {
        return $this->dateInscription;
    }

}
