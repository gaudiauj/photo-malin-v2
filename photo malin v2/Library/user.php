<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Library;

/**
 * Description of user
 * gére session
 * @author jeang
 */
session_start();

class User extends ApplicationComponent
{

    /**
     * recupere la valeur choisi de la session
     * @param $attr
     * @return null
     */
    public function getAttribute($attr)
    {
        return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
    }

    /**
     * @return mixed
     */
    public function getFlash()
    {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);

        return $flash;
    }

    /**
     * @return bool
     */
    public function hasFlash()
    {
        return isset($_SESSION['flash']);
    }

    /**
     * défini si l'utilisateur est inscrit en tant qu'admin
     * @return bool
     */
    public function isAuthenticated()
    {
        return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
    }

    /**
     * ajoute une valeur a la session
     * @param $attr
     * @param $value
     */
    public function setAttribute($attr, $value)
    {
        $_SESSION[$attr] = $value;
    }

    /**
     * authentifie l'utilisateur en tan qu'admin ou pas
     * @param bool $authenticated
     */
    public function setAuthenticated($authenticated = true)
    {
        if (!is_bool($authenticated))
        {
            throw new \InvalidArgumentException('La valeur spécifiée à la méthode User::setAuthenticated() doit être un boolean');
        }

        $_SESSION['auth'] = $authenticated;
    }

    /**
     * @param $value
     */
    public function setFlash($value)
    {
        $_SESSION['flash'] = $value;
    }

}
