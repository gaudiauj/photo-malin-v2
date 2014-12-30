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
class MembreManager_PDO extends MembreManager {

    public function add(Membre $membre) {

        if (!$this->exist($membre)) {
            $requete = $this->dao->prepare('INSERT INTO membre SET pseudo = :pseudo, mail = :mail, pass = :pass, dateInscription = NOW()');
            $requete->bindValue(':pseudo', $membre->getPseudo());
            $requete->bindValue(':mail', $membre->getMail());
            $requete->bindValue(':pass', $membre->getPass());

            $requete->execute();
            return TRUE;
        } else {
            return FALSE;
        }
    }

    protected function exist(Membre $membre) {
        $requete = $this->dao->prepare('SELECT id FROM membre WHERE pseudo= :pseudo OR mail= :mail');
        $requete->bindValue(':pseudo', $membre->getPseudo());
        $requete->bindValue(':mail', $membre->getMail());
        $requete->execute();

        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Library\Entities\Membre');

        if ($membre = $requete->fetch()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
     public function verifMembre(Membre $membre) {
        $requete = $this->dao->prepare('SELECT * FROM membre WHERE pseudo= :pseudo AND pass= :pass');
        $requete->bindValue(':pseudo', $membre->getPseudo());
        $requete->bindValue(':pass', $membre->getPass());
        $requete->execute();

        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Library\Entities\Membre');

        if ($membre = $requete->fetch()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function getPseudo($id)
    {
        $requete = $this->dao->prepare('SELECT pseudo FROM membre WHERE id= :id');
        $requete->bindValue(':id', $id, PDO::PARAM_INT);
        $requete->execute();
        
        return $requete->fetch();        
    }

}
