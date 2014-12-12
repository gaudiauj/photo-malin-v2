<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function autoload($class)
{
  require '../'.str_replace('\\', '/', $class).'.php';
}

spl_autoload_register('autoload');
