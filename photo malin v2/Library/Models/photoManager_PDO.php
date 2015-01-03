<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Library\Models;
use \Library\Entities\Photo;

/**
 * Description of photoManager_PDO
 *
 * @author jeang
 */
class photoManager_PDO extends photoManager
{

    public function add(Photo $photo)
    {
        $requete = $this->dao->prepare('INSERT INTO photo(auteur,nom_photo,titre,commentaire,extension,privee,appareil_photo,date_ajout,focale,iso,vit_obt,date_prise_photo) VALUES(:auteur,:nom_photo,:titre,:commentaire,:extension,:privee,:appareil_photo,now(),:focale,:iso,:vit_obt,:date_prise_photo)');
        $requete->execute(array(
            'auteur' => strtolower($photo->getauteur()),
            'nom_photo' => $photo->getnom_photo(),
            'titre' => $photo->gettitre(),
            'commentaire' => $photo->getcommentaire(),
            'extension' => $photo->getextension(),
            'privee' => $photo->getprivee(),
            'appareil_photo' => $photo->getappareil_photo(),
            'focale' => $photo->getfocale(),
            'iso' => $photo->getiso(),
            'vit_obt' => $photo->getvit_obt(),
            'date_prise_photo' => $photo->getdate_prise_photo()
        ));
    }

    public function delete(Photo $photo)
    {
        $requete = $this->dao->prepare('DELETE FROM photo WHERE nom_photo=?');
        $requete->execute(array($photo->getnom_photo()));
    }

    public function get($id)
    {
        $requete = $this->dao->prepare('SELECT * FROM photo WHERE id=:id ');
        $requete->execute(array(
            'id' => $id,
        ));
        $reponse = $requete->fetch();
        return $reponse;
    }

}
