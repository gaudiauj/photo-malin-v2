<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Library;

/**
 * Description of Manager
 *
 * @author jeang
 */
abstract class Manager
{

    protected $dao;

    public function __construct($dao)
    {
        $this->dao = $dao;
    }

}
