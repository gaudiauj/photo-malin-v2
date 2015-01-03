<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Library\Models;

/**
 * Description of CommentManager
 *
 * @author jeang
 */
use \Library\Entities\Comment;

abstract class CommentsManager extends \Library\Manager
{

    /**
     * Méthode permettant d'ajouter un commentaire
     * @param $comment Le commentaire à ajouter
     * @return void
     */
    abstract protected function add(Comment $comment);

    /**
     * Méthode permettant d'enregistrer un commentaire.
     * @param $comment Le commentaire à enregistrer
     * @return void
     */
    public function save(Comment $comment)
    {
        if ($comment->isValid()) {
            $comment->isNew() ? $this->add($comment) : $this->update($comment);
        } else {
            throw new \RuntimeException('Le commentaire doit être validé pour être enregistré');
        }
    }

    /**
     * Méthode permettant de récupérer une liste de commentaires.
     * @param $news La news sur laquelle on veut récupérer les commentaires
     * @return array
     */
    abstract public function getListOf($news);

    /**
     * Méthode permettant de modifier un commentaire.
     * @param $comment Le commentaire à modifier
     * @return void
     */
    abstract protected function update(Comment $comment);

    /**
     * Méthode permettant d'obtenir un commentaire spécifique.
     * @param $id L'identifiant du commentaire
     * @return Comment
     */
    abstract public function get($id);

    /**
     * Méthode permettant d'obtenir tout les commentaires.
     * 
     * @return array
     */
    abstract public function getall();

    /**
     * Méthode permettant de supprimer tout les commentaire dependant d'un news.
     * @param $id int L'identifiant de la news.
     * @return void
     */
    abstract public function deleteNewsId($id);

    /**
     * Méthode retournant une liste de commentaire demandée
     * @param $debut int Le première com à sélectionner
     * @param $limite int Le nombre de comm à sélectionner
     * @return array La liste des news. Chaque entrée est une instance de Comment.
     */
    abstract public function getList($debut = -1, $limite = -1);

    /**
     * Méthode permettant de supprimer un commentaire.
     * @param $id L'identifiant du commentaire à supprimer
     * @return void
     */
    abstract public function delete($id);

    /**
     * Méthode retournant une liste de commentaire demandée d'un membre precis
     * @param $debut int Le première com à sélectionner
     * @param $limite int Le nombre de comm à sélectionner
     * @param $pseudo string Le pseudo du membre
     * @return array La liste des news. Chaque entrée est une instance de Comment.
     */
    abstract public function getListMembre($pseudo, $debut = -1, $limite = -1);

    /**
     * Méthode retournant le nombre de commentaire 
     * @return int nombre de commentaire.
     */
    abstract public function count();
}
