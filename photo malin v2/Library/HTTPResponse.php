<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Library;

/**
 * Description of HTTPResponse
 *
 * @author jeang
 */
class HTTPResponse extends ApplicationComponent
{

    protected $page;

    public function addHeader($header)
    {
        header($header);
    }

    public function redirect($location)
    {
        header('location: ' . $location);
        exit;
    }

    public function send()
    {
        exit($this->page->getGeneratedPage());
    }

    public function setPage(Page $page)
    {
        $this->page = $page;
    }

    // Changement par rapport à la fonction setcookie() : le dernier argument est par défaut à true.
    public function setCookie($name, $value = '', $expire = 0, $path = null, $domain = null, $secure = false, $httpOnly = true)
    {
        setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
    }

    public function redirect404()
    {
        $this->page = new Page($this->app);
        $this->page->setContentFile(__DIR__ . '/../Errors/404.html');

        $this->addHeader('HTTP/1.0 404 Not Found');

        $this->send();
    }

}
