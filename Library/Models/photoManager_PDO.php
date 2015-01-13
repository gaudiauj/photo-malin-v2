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
        if ($photo->isValid()) {
            $requete = $this->dao->prepare('INSERT INTO photo(auteur,nom_photo,titre,commentaire,extension,privee,appareil_photo,date_ajout,focale,iso,vit_obt,date_prise_photo) VALUES(:auteur,:nom_photo,:titre,:commentaire,:extension,:privee,:appareil_photo,now(),:focale,:iso,:vit_obt,:date_prise_photo)');
            $requete->execute(array(
                'auteur' => strtolower($photo->getauteur()),
                'nom_photo' => $photo->getnom_photo(),
                'titre' => $photo->gettitre(),
                'commentaire' => $photo->getcommentaire(),
                'extension' => $photo->getextension(),
                'privee' => $photo->getprivee(),
                'appareil_photo' => $photo->getExif()->getappareil_photo(),
                'focale' => $photo->getExif()->getfocale(),
                'iso' => $photo->getExif()->getiso(),
                'vit_obt' => $photo->getExif()->getvit_obt(),
                'date_prise_photo' => $photo->getExif()->getdate_prise_photo()
            ));
        }
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

    public function searchPublic($nomRecherche = "", $debut = -1, $limite = -1, $typeDeTrie = self::DECROISSANT)
    {
        $sql = 'SELECT * FROM photo WHERE privee="public" AND commentaire LIKE "%' . $nomRecherche . '%" OR titre LIKE "%' . $nomRecherche . '%" OR auteur LIKE "%' . $nomRecherche . '%" ORDER BY id ' . $typeDeTrie;
        if ($debut != -1 || $limite != -1) {
            $sql .= ' LIMIT ' . (int) $limite . ' OFFSET ' . (int) $debut;
        }
        $requete = $this->dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_ASSOC);
        $arrayphoto = $requete->fetchAll();
        foreach ($arrayphoto as $array) {
            $array['iso']= (int) $array['iso'];
            $photos[] = new \Library\Entities\photo($array);
        }
        foreach ($photos as $photo) {
            $photo->getExif()->setDate_prise_photo(new \DateTime($photo->getExif()->getDate_prise_photo()));
        }
        $requete->closeCursor();

        return $photos;
    }

}
