<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Library;

/**
 * Description of HTTPRequest
 *
 * @author jeang
 */
class HTTPRequest {
   public function cookieData($key)
  {
    return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
  }
  
  public function cookieExists($key)
  {
    return isset($_COOKIE[$key]);
  }
  
  public function getData($key)
  {
    return isset($_GET[$key]) ? $_GET[$key] : null;
  }
  
  public function getExists($key)
  {
    return isset($_GET[$key]);
  }
  
  public function method()
  {
    return $_SERVER['REQUEST_METHOD'];
  }
  
  public function postData($key)
  {
    return isset($_POST[$key]) ? $_POST[$key] : null;
  }
  
  public function postExists($key)
  {
    return isset($_POST[$key]);
  }
  
  public function requestURI()
  {
    return $_SERVER['REQUEST_URI'];
  }
}
