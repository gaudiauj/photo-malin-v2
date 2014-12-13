<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Library\Models;

/**
 * Description of NewsManager
 *
 * @author jeang
 */
abstract class NewsManager extends \Library\Manager{
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
   * Méthode retournant unela derniere News.
   * 
   * @return News La derniere news 
   */
  abstract public function getLast();
}
