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
class MembreController extends \Library\BackController {

    public function executeAfficheInscrire(\Library\HTTPRequest $request) {
        $this->page->addVars('title', 'Inscription');
    }

    public function executeInscription(\Library\HTTPRequest $request) {
        $manager = $this->managers->getManagerOf('Membre');
        if ($request->postExists('pseudo') && $request->postData('pass_insc') == $request->postData('pass_insc_verif')) {
            $membre = new \Library\Entities\Membre(array(
                'pseudo' => $request->postData('pseudo'),
                'pass' => $request->postData('pass_insc'),
                'mail' => $request->postData('mail_insc')
            ));
            if ($membre->isValid()) {
                if ($manager->add($membre)) {
                    $this->page->addVars('reussite', true);
                } else {
                    $this->page->addVars('reussite', FALSE);
                }
            } else {
                $this->page->addVars('erreurs', $membre->erreurs());
            }
        }
    }

}
