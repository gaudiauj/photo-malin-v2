<?php

namespace Library;

/**
 * Description of Managers
 *
 * @author jeang
 */
class Managers
{

    protected $api = null;
    protected $dao = null;
    protected $managers = array();

    /**
     * @param $api
     * @param $dao
     */
    public function __construct($api, $dao)
    {
        $this->dao = $dao;
        $this->api = $api;
    }

    /**
     * renvoi le Manager demandé
     * @param $module
     * @return manager
     */
    public function getManagerOf($module)
    {
        if (!is_string($module) || empty($module))
        {
            throw new \InvalidArgumentException('Le module spécifié est invalide');
        }
        if (!isset($this->managers[$module]))
        {
            $managerinst = '\\Library\\Models\\' . $module . 'Manager_' . $this->api;
            $this->managers[$module] = new $managerinst($this->dao);
        }

        return $this->managers[$module];
    }

}
