<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Library\Models;
use \Library\Entities\Photo;

/**
 * Description of photoManager
 *
 * @author jeang
 */
abstract class photoManager extends \Library\Manager
{
    /**
     * Méthode permettant d'ajouter une photo.
     * @param $photo photo à ajouter
     * @return void
     */
    abstract protected function add(Photo $photo);
    
    /**
     * Méthode permettant de supprimer une photo.
     * @param $id int L'identifiant de la photo à supprimer
     * @return void
     */
    abstract public function delete(Photo $photo);
    
     /**
     * Méthode permettant de recuperer une photo.
     * @param $id int L'identifiant de la photo à recuperer
     * @return photo photo demander
     */
    abstract public function get($id);
}
