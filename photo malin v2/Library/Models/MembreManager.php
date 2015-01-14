<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Library\Models;

use \Library\Entities\Membre;

/**
 * Description of MembreManager
 *
 * @author jeang
 */
abstract class MembreManager extends \Library\Manager
{

    /**
     * Méthode permettant d'ajouter un membre retourne true si tout c'est bien passé false si le pseudo ou mail existe déja dans la bdd
     * @param Membre|Le $membre Le membre à ajouter
     * @return bool
     */
    abstract protected function add(Membre $membre);

    public function save(News $news)
    {
        if ($news->isValid()) {
            $news->isNew() ? $this->add($news) : $this->update($news);
        } else {
            throw new \RuntimeException('Le membre doit être valide pour être enregistrée');
        }
    }

    /**
     * Méthode permettant de savoir si un membre existe déja
     * @param Membre|le $membre le membte à verifier
     * @return bool
     */
    abstract protected function exist(Membre $membre);

    /**
     * Méthode permettant de verifier si un membre existe avec son pseudo et pass.
     * @param Membre|le $membre le membte à verifier
     * @return bool
     */
    abstract public function verifMembre(Membre $membre);

    /**
     * Méthode permettant de recuperer le pseudo d'un membre
     * @param $id id du membre
     * @return Strings
     */
    abstract public function getPseudo($id);

    /**
     * Méthode permettant de recuperer le pseudo d'un membre
     * @return Strings
     * @internal param id $id du membre
     */
    abstract public function getList();

    /**
     * Méthode retournant le nombre de membre
     * @return int nombre de membre.
     */
    abstract public function count();

    /**
     * Méthode permettant de supprimer un membre.
     * @param $pseudo
     * @return
     * @internal param L $id 'identifiant du commentaire à supprimer
     */
    abstract public function delete($pseudo);
}
