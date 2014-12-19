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

        $this->page->addVars('listeNews', $manager->getList());
        $this->page->addVars('nombreNews', $manager->count());
    }
    
     public function executeInsert(\Library\HTTPRequest $request)
  {
    if ($request->postExists('auteur'))
    {
      $this->processForm($request);
    }    
    $this->page->addVars('title', 'Ajout d\'une news');
  }
  
  public function processForm(\Library\HTTPRequest $request)
  {
    $news = new \Library\Entities\News(
      array(
        'auteur' => $request->postData('auteur'),
        'titre' => $request->postData('titre'),
        'contenu' => $request->postData('contenu')
      )
    );
    
    // L'identifiant de la news est transmis si on veut la modifier.
    if ($request->postExists('id'))
    {
      $news->setId($request->postData('id'));
    }
    
    if ($news->isValid())
    {
      $this->managers->getManagerOf('News')->save($news);
      
      $this->app->user()->setFlash($news->isNew() ? 'La news a bien été ajoutée !' : 'La news a bien été modifiée !');
    }
    else
    {
      $this->page->addVars('erreurs', $news->erreurs());
    }
    
    $this->page->addVars('news', $news);
  }

  public function executeDelete(\Library\HTTPRequest $request)
  {
    $this->managers->getManagerOf('News')->delete($request->getData('id'));
    
    $this->app->user()->setFlash('La news a bien été supprimée !');
    
    $this->app->httpResponse()->redirect('news');
  }
  
  public function executeUpdate(\Library\HTTPRequest $request)
  {
    if ($request->postExists('auteur'))
    {
      $this->processForm($request);
    }
    else
    {
      $this->page->addVars('news', $this->managers->getManagerOf('News')->getUnique($request->getData('id')));
    }
    
    $this->page->addVars('title', 'Modification d\'une news');
  }
}
