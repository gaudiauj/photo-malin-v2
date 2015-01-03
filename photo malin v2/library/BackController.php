<?php

namespace Library;

/**
 * Description of BackController
 *
 * @author jeang
 */
class BackController extends ApplicationComponent
{

    protected $action;
    protected $module;
    protected $page;
    protected $view;
    protected $managers;

    public function __construct(Application $app, $module, $action)
    {
        parent::__construct($app);
        $this->page = new page($app);
        $this->setModule($module);
        $this->setAction($action);
        $this->setView($action);
        $this->managers = new Managers('PDO', PDOFactory::getMysqlConnexionPDO());
    }

    public function execute()
    {
        $methode = 'execute' . ucfirst($this->action);
        if (!is_callable(array($this, $methode)))
        {
            throw new \RuntimeException('L\'action' . $this->action . 'n\existe pas');
        }
        $this->$methode($this->app->httpRequest());
    }

    public function page()
    {
        return $this->page;
    }

    public function setModule($module)
    {
        if (!is_string($module) || empty($module))
        {
            throw new \InvalidArgumentException('Le module doit être une chaine de caractères valide');
        }

        $this->module = $module;
    }

    public function setAction($action)
    {
        if (!is_string($action) || empty($action))
        {
            throw new \InvalidArgumentException('L\'action doit être une chaine de caractères valide');
        }

        $this->action = $action;
    }

    public function setView($view)
    {
        if (!is_string($view) || empty($view))
        {
            throw new \InvalidArgumentException('La vue doit être une chaine de caractères valide');
        }

        $this->view = $view;
        $this->page->setContentFile(__DIR__ . '/../Applications/' . $this->app->name() . '/Modules/' . $this->module . '/Views/' . $this->view . '.php');
    }

}
