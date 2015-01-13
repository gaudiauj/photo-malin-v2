<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Applications\Frontend\Modules\photo;

/**
 * Description of PhotoController
 *
 * @author jeang
 */
class PhotoController extends \Library\BackController
{

    public function executeAjoutPhoto(\Library\HTTPRequest $request)
    {
        if (!empty($_SESSION['pseudo'])) {
            $this->page->addVars('title', 'ajouter des photos');
        } else {
            $this->app->httpResponse()->redirect404();
        }
    }

    public function executeAjout(\Library\HTTPRequest $request)
    {
        $this->page->addVars('title', 'ajout photos');
        if ($request->postExists('titre')) {
            $this->page->addVars('noLayout', true);
            $files = $request->postFiles();
            $ajoutphoto = new PhotoClass($request->postDataArray(), $files, $this->app->config()->get('chemin_photo'));
            $tailleMax = $this->app->config()->get('taille_photo');
            if ($files['fichier']['error'] > 1) {
                $reponse = ($files['fichier']['error']);
            } else {
                if ($files['fichier']['size'] <= $tailleMax AND $files['fichier']['error'] == 0) {
                    $photo = $ajoutphoto->ajoutphoto($this->app->config()->get('chemin_miniature'));
                    $this->managers->getManagerOf('Photo')->add($photo);
                    $reponse = $photo->erreurs();
                } else {
                    $reponse = "fichier trop volumineux photo limité a 2mo";
                }
            }
            $this->page->addVars('reponse', $reponse);
        } else {
            $this->app->httpResponse()->redirect($request->previousURL());
        }
    }

    public function executeAffichePublic(\Library\HTTPRequest $request)
    {
        $this->page->addVars('title', 'photos public');
    }

    public function executephotoPublic(\Library\HTTPRequest $request)
    {
        $this->page->addVars('title', 'photos public');
        $this->page->addVars('noLayout', true);
        $nombrePhoto=$this->app->config()->get('nombrePhoto');
        $photos = $this->managers->getManagerOf('photo')->searchpublic();
        if ($request->postExists('plus_photo'))
        {
            $plus_photo=$request->postData('plus_photo');
            $photos = $this->managers->getManagerOf('photo')->searchpublic("",0,$plus_photo * $nombrePhoto);
        }
        $this->page->addVars('photos', $photos);
    }

}
