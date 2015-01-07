<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Library;

/**
 * Description of Router
 * Router de l'application
 * @author jeang
 */
class Router
{

    protected $routes = array();

    const NO_ROUTE = 1;

    /**
     * ajoute une route
     * @param Route $route
     */
    public function addRoute(Route $route)
    {
        if (!in_array($route, $this->routes))
        {
            $this->routes[] = $route;
        }
    }

    /**
     * recupere toutes les routes
     * @param $url
     * @return mixed
     */
    public function getRoute($url)
    {
        foreach ($this->routes as $route)
        {
            $varsValues = $route->match($url);
            if ($varsValues !== false)
            {
                if ($route->hasVars())
                {
                    $varsnames = $route->varsNames();
                    $listVars = array();
                    foreach ($varsValues as $key => $match)
                    {
                        // La première valeur contient entièrement la chaine capturée (voir la doc sur preg_match).
                        if ($key !== 0)
                        {
                            $listVars[$varsnames[$key - 1]] = $match;
                        }
                    }
                    $route->setVars($listVars);
                }
                return $route;
            }
        }

        throw new \RuntimeException('aucune route ne correspond a l\'url', self::NO_ROUTE);
    }

}
