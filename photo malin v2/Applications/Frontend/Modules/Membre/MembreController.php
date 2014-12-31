<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Applications\Frontend\Modules\Membre;

/**
 * Description of MembreController
 *
 * @author jeang
 */
class MembreController extends \Library\BackController
{

    public function executeAfficheInscrire(\Library\HTTPRequest $request)
    {
        $this->page->addVars('title', 'Inscription');
    }

    public function executeInscription(\Library\HTTPRequest $request)
    {
        $this->page->addVars('noLayout', true);
        $manager = $this->managers->getManagerOf('Membre');
        if ($request->postExists('pseudo'))
        {
            if (!($request->postData('pass_insc') == $request->postData('pass_insc_verif')))
            {
                $this->page->addVars('matchpass', false);
            } else
            {
                $membre = new \Library\Entities\Membre(array(
                    'pseudo' => $request->postData('pseudo'),
                    'pass' => $request->postData('pass_insc'),
                    'mail' => $request->postData('mail_insc')
                ));
                if ($membre->isValid())
                {
                    if ($manager->add($membre))
                    {
                        $this->page->addVars('reussite', true);
                    } else
                    {
                        $this->page->addVars('reussite', false);
                    }
                } else
                {
                    $this->page->addVars('erreurs', $membre->erreurs());
                }
            }
        }
    }

    public function executeConnexion(\Library\HTTPRequest $request)
    {
        $this->page->addVars('title', 'Connexion');
        if ($request->postExists('pseudo_co') && $request->postData('pass_insc') == $request->postData('pass_insc_verif'))
        {
            $membre = new \Library\Entities\Membre(array(
                'pseudo' => $request->postData('pseudo_co'),
                'pass' => $request->postData('pass_co'),
            ));
            $manager = $this->managers->getManagerOf('Membre');
            if ($manager->verifMembre($membre))
            {
                $this->app->user()->setAttribute('pseudo', $membre->getPseudo());
                $connecte = true;
            } else
            {
                $connecte = false;
            }
            $this->page->addVars('connecte', $connecte);
        }
    }

    public function executeDeconnexion(\Library\HTTPRequest $request)
    {
        $this->page->addVars('title', 'Deconnexion');
        $this->app->user()->setAttribute('pseudo', null);
        $this->app->httpResponse()->redirect($request->previousURL());
    }

    public function executeProfil(\Library\HTTPRequest $request)
    {
        $membreManager = $this->managers->getManagerOf('Membre');
        $pseudo = $request->getData('pseudo');
        $this->page->addVars('title', 'profils de ' . $pseudo);
        $this->page->addVars('pseudo', $pseudo);
        $this->page->addVars('profil', true);
        $membre = new \Library\Entities\Membre(array(
            'pseudo' => $pseudo
        ));

        if ($membreManager->exist($membre))
        {
            $this->processComments($request, $pseudo);
        } else
        {
            $this->page->addVars('profil', false);
        }
    }

    protected function processComments(\Library\HTTPRequest $request, $pseudo)
    {
        $nombreCaracteres = $this->app->config()->get('nombre_caracteres');
        $commentsManager = $this->managers->getManagerOf('Comments');
        $nombrecomm = $this->app->config()->get('nombre_comm_profil');
        $listeComments = $commentsManager->getListMembre($pseudo, 0, $nombrecomm);
        foreach ($listeComments as $Comments)
        {
            if (strlen($Comments->contenu()) > $nombreCaracteres)
            {
                $debut = substr($Comments->contenu(), 0, $nombreCaracteres);
                $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';

                $Comments->setContenu($debut);
            }
        }
        $this->page->addVars('nombrecomm', $nombrecomm);
        $this->page->addVars('comments', $listeComments);
    }

}
