<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Library;

/**
 * Description of Entity
 *
 * @author jeang
 */
abstract class Entity implements \ArrayAccess
{

    protected $erreurs = array();
    protected $id;

    /**
     * @param array $donnees
     */
    public function __construct(array $donnees = array())
    {
        if (!empty($donnees)) {
            $this->hydrate($donnees);
        }
    }

    /**
     * @return bool
     */
    public function isNew()
    {
        return empty($this->id);
    }

    /**
     * srock les erreurs sous dans un array
     * @return array
     */
    public function erreurs()
    {
        return $this->erreurs;
    }

    /**
     * renvoi l'id de l'entity
     * @return int
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = (int) $id;
    }

    /**
     * hydrate les données
     * @param array $donnees
     */
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $attribut => $valeur)
        {
            $methode = 'set' . ucfirst($attribut);

            if (is_callable(array($this, $methode))) {
                $this->$methode($valeur);
            }
        }
    }

    /**
     * @param mixed $var
     * @return mixed
     */
    public function offsetGet($var)
    {
        if (isset($this->$var) && is_callable(array($this, $var))) {
            return $this->$var();
        } else {
            return null;
        }
    }

    /**
     * @param mixed $var
     * @param mixed $value
     */
    public function offsetSet($var, $value)
    {
        $method = 'set' . ucfirst($var);

        if (isset($this->$var) && is_callable(array($this, $method))) {
            $this->$method($value);
        }
    }

    /**
     * @param mixed $var
     * @return bool
     */
    public function offsetExists($var)
    {
        return isset($this->$var) && is_callable(array($this, $var));
    }

    /**
     * @param mixed $var
     * @throws \Exception
     */
    public function offsetUnset($var)
    {
        throw new \Exception('Impossible de supprimer une quelconque valeur');
    }
}
