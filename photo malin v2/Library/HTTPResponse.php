<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Library;

/**
 * Description of HTTPResponse
 * reponse renvoyer a l'utilisateur
 * @author jeang
 */
class HTTPResponse extends ApplicationComponent
{

    protected $page;

    /**
     * ajoute le header choisi
     * @param $header
     */
    public function addHeader($header)
    {
        header($header);
    }

    /**
     * redirection a la destination choisi
     * @param $location
     */
    public function redirect($location)
    {
        header('location: ' . $location);
        exit;
    }

    /**
     * envoi la page généré
     */
    public function send()
    {
        exit($this->page->getGeneratedPage());
    }

    /**
     * creer une page
     * @param Page $page
     */
    public function setPage(Page $page)
    {
        $this->page = $page;
    }


    /**
     * ajoute une cookies, Changement par rapport à la fonction setcookie() : le dernier argument est par défaut à true.
     * @param $name
     * @param string $value
     * @param int $expire
     * @param null $path
     * @param null $domain
     * @param bool $secure
     * @param bool $httpOnly
     */
    public function setCookie($name, $value = '', $expire = 0, $path = null,
                              $domain = null, $secure = false, $httpOnly = true)
    {
        setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
    }

    /**
     * renvoi sur la page erreur 404
     */
    public function redirect404()
    {
        $this->page = new Page($this->app);
        $this->page->setContentFile(__DIR__ . '/../Errors/404.html');

        $this->addHeader('HTTP/1.0 404 Not Found');

        $this->send();
    }

}
