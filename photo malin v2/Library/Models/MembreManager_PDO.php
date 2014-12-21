<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Library\Models;
use \Library\Entities\Membre;
/**
 * Description of MembreManager_PDO
 *
 * @author jeang
 */
class MembreManager_PDO extends MembreManager{

    public function add(Membre $membre) {
     {
    $requete = $this->dao->prepare('INSERT INTO membre SET pseudo = :pseudo, mail = :mail, pass = :pass, dateInscription = NOW()');
    
    $requete->bindValue(':pseudo', $membre->getPseudo());
    $requete->bindValue(':mail', $membre->getMail());
    $requete->bindValue(':pass', $membre->getPass());
    
    $requete->execute();
     } 
    }
}
