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
abstract class MembreManager extends \Library\Manager {

    /**
     * Méthode permettant d'ajouter un membre
     * @param $membre Le commentaire à ajouter
     * @return void
     */
    abstract protected function add(Membre $membre);

    public function save(News $news) {
        if ($news->isValid()) {
            $news->isNew() ? $this->add($news) : $this->update($news);
        } else {
            throw new \RuntimeException('Le membre doit être valide pour être enregistrée');
        }
    }

}
