<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Applications\Backend;

/**
 * Description of BackendApplication
 *
 * @author jeang
 */
class BackendApplication extends \Library\Application {
    
    public function __construct() {
        parent::__construct();
        $this->name="Backend";               
    }
    
    public function run()
    {
        if ($this->user->isAuthenticated())
        {
            $controller = $this->getController();
        }
        else
        {
            $controller = new Modules\Connexion\ConnexionController ($this, 'Connexion', 'index' );
        }
        $controller->execute();
        
       $this->httpResponse->setPage($controller->page());
       $this->httpResponse->send();
    }
    
}
