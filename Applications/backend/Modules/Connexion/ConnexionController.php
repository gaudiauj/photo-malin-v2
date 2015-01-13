<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Applications\Backend\Modules\Connexion;

/**
 * Description of ConnexionController
 *
 * @author jeang
 */
class ConnexionController extends \Library\BackController
{

    public function executeIndex(\Library\HTTPRequest $request)
    {
        $this->page->addVars('title', 'Connexion');
        if ($request->postExists('pseudo')) {
            $login = $request->postData('pseudo');
            $password = $request->postData('pass');

            if ($login == $this->app->config()->get('login') && $password == $this->app->config()->get('pass')) {
                $this->app->user()->setAuthenticated(true);
                $this->app->httpResponse()->redirect('news-page-1');
            } else {
                $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.');
            }
        }
    }

    public function executeDeco(\Library\HTTPRequest $request)
    {
        $this->page->addVars('title', 'deconnexion');
        $this->app->user()->setAuthenticated(false);
        $this->app->httpResponse()->redirect('../');
    }

}
