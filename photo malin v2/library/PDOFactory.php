<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Library;

/**
 * Description of PDOFactory
 *
 * @author jeang
 */
class PDOFactory {
    public static function getMysqlConnexionPDO()
  {
    $db = new \PDO('mysql:host=localhost;dbname=news', 'root', '');
    $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    
    return $db;
  }
}
