<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Library;

/**
 * Description of Page
 *
 * @author jeang
 */
class Page extends ApplicationComponent {

    protected $contentFile;
    protected $vars = array();

    public function addVars($var, $value) {
        if (!is_string($var) || is_numeric($var) || empty($var)) {
            throw new \InvalidArgumentException('mauvais nom de variable');
        }

        $this->vars[$var] = $value;
    }

    public function getGeneratedPage() {
        var_dump($this->contentFile);
        if (!file_exists($this->contentFile)) {
            throw new \RuntimeException('La vue spécifiée n\'existe pas');
        }
        $user = $this->app->user();

        extract($this->vars);

        ob_start();
        require $this->contentFile;
        $content = ob_get_clean();

        ob_start();
        require __DIR__ . '/../Applications/' . $this->app->name() . '/Templates/layout.php';
        return ob_get_clean();
    }

    public function setContentFile($contentFile) {
        if (!is_string($contentFile) || empty($contentFile)) {
            throw new \InvalidArgumentException('La vue spécifiée est invalide');
        }

        $this->contentFile = $contentFile;
    }

}
