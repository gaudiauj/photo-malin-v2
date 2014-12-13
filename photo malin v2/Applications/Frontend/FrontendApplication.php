<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Applications\Frontend;

/**
 * Description of FrontendApplication
 *
 * @author jeang
 */
class FrontendApplication extends \Library\Application {

    public function __construct() {
        parent::__construct();

        $this->name = 'Frontend';
    }

    public function run() {
        $controller = $this->getController();
        $controller->execute();

        $this->httpResponse->setPage($controller->page());
        $this->httpResponse->send();
    }

}
