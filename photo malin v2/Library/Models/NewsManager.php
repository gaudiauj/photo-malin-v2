<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Library\Models;

use \Library\Entities\News;

/**
 * Description of NewsManager
 *
 * @author jeang
 */
abstract class NewsManager extends \Library\Manager
{

    /**
     * Méthode retournant une liste de news demandée
     * @param $debut int La première news à sélectionner
     * @param $limite int Le nombre de news à sélectionner
     * @return array La liste des news. Chaque entrée est une instance de News.
     */
    abstract public function getList($debut = -1, $limite = -1);

    /**
     * Méthode retournant une news précise.
     * @param $id int L'identifiant de la news à récupérer
     * @return News La news demandée
     */
    abstract public function getUnique($id);

    /**
     * Méthode retournant la derniere News.
     * 
     * @return News La derniere news 
     */
    abstract public function getLast();

    /**
     * Méthode renvoyant le nombre de news total.
     * @return int
     */
    abstract public function count();

    /**
     * Méthode permettant d'ajouter une news.
     * @param $news News La news à ajouter
     * @return void
     */
    abstract protected function add(News $news);

    /**
     * Méthode permettant d'enregistrer une news.
     * @param $news News la news à enregistrer
     * @see self::add()
     * @see self::update()
     * @return void
     */
    public function save(News $news)
    {
        if ($news->isValid())
        {
            $news->isNew() ? $this->add($news) : $this->update($news);
        } else
        {
            throw new \RuntimeException('La news doit être validée pour être enregistrée');
        }
    }

    /**
     * Méthode permettant de supprimer une news.
     * @param $id int L'identifiant de la news à supprimer
     * @return void
     */
    abstract public function delete($id);

    /**
     * Méthode permettant de modifier une news.
     * @param $news news la news à modifier
     * @return void
     */
    abstract protected function update(News $news);
}
