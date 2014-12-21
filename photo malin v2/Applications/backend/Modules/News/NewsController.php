<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Applications\Backend\Modules\News;

/**
 * Description of NewsController
 * controller for backend news
 * @author jeang
 */
class NewsController extends \Library\BackController {

    public function executeIndex(\Library\HTTPRequest $request) {
        $this->page->addVars('title', 'Gestion des news');

        $manager = $this->managers->getManagerOf('News');

        $nombreNews = $this->app->config()->get('nombre_news');
        $listeNews = $manager->getList(($request->getData('page') - 1) * $nombreNews, $request->getData('page') * $nombreNews);

        $this->page->addVars('nombrepage', (int) round(($manager->count() / $nombreNews) + 0.5, 0, PHP_ROUND_HALF_UP));
        $this->page->addVars('page', $request->getData('page'));
        $this->page->addVars('listeNews', $listeNews);
        $this->page->addVars('nombreNews', $manager->count());
    }

    public function executeInsert(\Library\HTTPRequest $request) {
        if ($request->postExists('auteur')) {
            $this->processForm($request);
        }
        $this->page->addVars('title', 'Ajout d\'une news');
    }

    public function processForm(\Library\HTTPRequest $request) {
        $news = new \Library\Entities\News(
                array(
            'auteur' => $request->postData('auteur'),
            'titre' => $request->postData('titre'),
            'contenu' => $request->postData('contenu')
                )
        );

        // L'identifiant de la news est transmis si on veut la modifier.
        if ($request->postExists('id')) {
            $news->setId($request->postData('id'));
        }

        if ($news->isValid()) {
            $this->managers->getManagerOf('News')->save($news);

            $this->app->user()->setFlash($news->isNew() ? 'La news a bien été ajoutée !' : 'La news a bien été modifiée !');
        } else {
            $this->page->addVars('erreurs', $news->erreurs());
        }

        $this->page->addVars('news', $news);
    }

    public function executeDelete(\Library\HTTPRequest $request) {
        $this->managers->getManagerOf('News')->delete($request->getData('id'));
        $this->managers->getManagerOf('Comments')->deleteNewsId($request->getData('id'));
        $this->app->user()->setFlash('La news a bien été supprimée !');

        $this->app->httpResponse()->redirect($request->previousURL());
    }

    public function executeUpdate(\Library\HTTPRequest $request) {
        if ($request->postExists('auteur')) {
            $this->processForm($request);
        } else {
            $this->page->addVars('news', $this->managers->getManagerOf('News')->getUnique($request->getData('id')));
        }

        $this->page->addVars('title', 'Modification d\'une news');
    }

    public function executeUpdateComment(\Library\HTTPRequest $request) {
        $this->page->addVars('title', 'Modification d\'un commentaire');

        if ($request->postExists('pseudo')) {
            $comment = new \Library\Entities\Comment(array(
                'id' => $request->getData('id'),
                'auteur' => $request->postData('pseudo'),
                'contenu' => $request->postData('contenu')
            ));

            if ($comment->isValid()) {
                $this->managers->getManagerOf('Comments')->save($comment);

                $this->app->user()->setFlash('Le commentaire a bien été modifié !');

                $this->app->httpResponse()->redirect('/news-' . $request->postData('news') . '.html');
            } else {
                $this->page->addVars('erreurs', $comment->erreurs());
            }

            $this->page->addVars('comment', $comment);
        } else {
            $this->page->addVars('comment', $this->managers->getManagerOf('Comments')->get($request->getData('id')));
        }
    }

    public function executeComments(\Library\HTTPRequest $request) {
        $this->page->addVars('title', 'Gestion des commentaires');
        
        $nombreComments = $this->app->config()->get('nombre_comments');
        $nombreCaracteres = $this->app->config()->get('nombre_caracteres_comments');
        $manager = $this->managers->getManagerOf('Comments');
        $listeComments = $manager->getList(($request->getData('page') - 1) * $nombreComments, $request->getData('page') * $nombreComments);
      
        foreach ($listeComments as $Comments) {
            if (strlen($Comments->contenu()) > $nombreCaracteres) {
                $debut = substr($Comments->contenu(), 0, $nombreCaracteres);
                $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';

                $Comments->setContenu($debut);
            }
        }
        $this->page->addVars('page', $request->getData('page'));
        $this->page->addVars('nombrepage', (int) ceil (($manager->count() / $nombreComments)));
        $this->page->addVars('listeComments', $listeComments);
        $this->page->addVars('nombreComments', $manager->count());
    }

    public function executeDeleteComment(\Library\HTTPRequest $request) {
        $this->managers->getManagerOf('Comments')->delete($request->getData('id'));

        $this->app->user()->setFlash('Le commentaire a bien été supprimé !');

        $this->app->httpResponse()->redirect($request->previousURL());
    }

}
