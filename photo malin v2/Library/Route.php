<?php

namespace Library;

/**
 * Description of Route
 * défini une route
 * @author jeang
 */
class Route
{

    protected $action;
    protected $module;
    protected $url;
    protected $varsNames;
    protected $vars = array();

    /**
     * @param $url
     * @param $module
     * @param $action
     * @param array $varsNames
     */
    public function __construct($url, $module, $action, array $varsNames)
    {
        $this->setUrl($url);
        $this->setModule($module);
        $this->setAction($action);
        $this->setVarsNames($varsNames);
    }

    /**
     * retourne vrai si la route contient des variables faux sinon
     * @return bool
     */
    public function hasVars()
    {
        return !empty($this->varsNames);
    }

    /**
     * compare une url donné avec l'url de la route
     * @param $url
     * @return bool
     */
    public function match($url)
    {
        if (preg_match('`^' . $this->url . '$`', $url, $matches))
        {
            return $matches;
        } else
        {
            return false;
        }
    }

    /**
     * definir l'action à effectuer pour le controlleur
     * @param $action
     */
    public function setAction($action)
    {
        if (is_string($action))
        {
            $this->action = $action;
        }
    }

    /**
     * definir le module à appeler
     * @param $module
     */
    public function setModule($module)
    {
        if (is_string($module))
        {
            $this->module = $module;
        }
    }

    /**
     * ajoute une url
     * @param $url
     */
    public function setUrl($url)
    {
        if (is_string($url))
        {
            $this->url = $url;
        }
    }

    /**
     * ajoute le nom des variables
     * @param array $varsNames
     */
    public function setVarsNames(array $varsNames)
    {
        $this->varsNames = $varsNames;
    }

    /**
     * defini les variables
     * @param array $vars
     */
    public function setVars(array $vars)
    {
        $this->vars = $vars;
    }

    /**
     * renvoi l'action à effectuer
     * @return mixed
     */
    public function action()
    {
        return $this->action;
    }

    /**
     * renvoi le module à utiliser
     * @return mixed
     */
    public function module()
    {
        return $this->module;
    }

    /**
     * renvoi les variables
     * @return array
     */
    public function vars()
    {
        return $this->vars;
    }

    /**
     * renvoi le nom des variables
     * @return mixed
     */
    public function varsNames()
    {
        return $this->varsNames;
    }

}
