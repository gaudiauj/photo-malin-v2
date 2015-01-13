<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Applications\Backend\Modules\Membre;

/**
 * Description of membreController
 *
 * @author jeang
 */
class membreController extends \Library\BackController
{

    public function executeMembres(\Library\HTTPRequest $request)
    {
        $this->page->addVars('title', 'Gestion des membres');
        $nombreMembres = $this->app->config()->get('nombre_membres');
        $manager = $this->managers->getManagerOf('Membre');
        $page = $request->getData('page');
        $nombrePage = (int) ceil(($manager->count() / $nombreMembres));
        if ($page > 0 && $page <= $nombrePage) {
            $listeMembre = $manager->getList(($page - 1) * $nombreMembres, $page * $nombreMembres);
            $this->page->addVars('page', $page);
            $this->page->addVars('nombrepage', $nombrePage);
            $this->page->addVars('listeMembres', $listeMembre);
            $this->page->addVars('nombreMembres', $manager->count());
            $this->page->addVars('url', 'membre-list');
        } else {
            $this->app->httpResponse()->redirect404();
        }
    }

    public function executeDelete(\Library\HTTPRequest $request)
    {
        $manager = $this->managers->getManagerOf('Membre');
        $manager->delete($request->getData('pseudo'));
        $this->app->user()->setFlash('le membre a bien été supprimée !');
        $this->app->httpResponse()->redirect($request->previousURL());
    }

}
