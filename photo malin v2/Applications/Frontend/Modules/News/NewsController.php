<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Applications\Frontend\Modules\News;

/**
 * Description of NewsController
 *
 * @author jeang
 */
class NewsController extends \Library\BackController {

    public function executeNews(\Library\HTTPRequest $request) {
        $nombreNews = $this->app->config()->get('nombre_news');
        $nombreCaracteres = $this->app->config()->get('nombre_caracteres');

        // On ajoute une définition pour le titre.
        $this->page->addVars('title', 'Liste des ' . $nombreNews . ' dernières news');

        // On récupère le manager des news.
        $manager = $this->managers->getManagerOf('News');

        // Cette ligne, vous ne pouviez pas la deviner sachant qu'on n'a pas encore touché au modèle.
        // Contentez-vous donc d'écrire cette instruction, nous implémenterons la méthode ensuite.
        $listeNews = $manager->getList(0, $nombreNews);

        foreach ($listeNews as $news) {
            if (strlen($news->contenu()) > $nombreCaracteres) {
                $debut = substr($news->contenu(), 0, $nombreCaracteres);
                $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';

                $news->setContenu($debut);
            }
        }

        // On ajoute la variable $listeNews à la vue.
        $this->page->addVars('listeNews', $listeNews);
    }

    public function executeShow(\Library\HTTPRequest $request) {
        $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));

        if (empty($news)) {
            $this->app->httpResponse()->redirect404();
        }

        $this->page->addVars('title', $news->titre());
        $this->page->addVars('news', $news);
    }

    public function executeIndex(\Library\HTTPRequest $request) {
        $news = $this->managers->getManagerOf('News')->getLast();
        var_dump ($news);
        if (empty($news)) {
            $this->app->httpResponse()->redirect404();
        }

        $this->page->addVars('title', $news->titre());
        $this->page->addVars('news', $news);
    }

}
