<?php
/**
 * Created by PhpStorm.
 * User: FRITZBAY
 * Date: 25/01/2018
 * Time: 07h46.
 */

namespace App\config;

use PDO;

class Database
{
    private $db_host1;
    private $db_name1;
    private $db_user1;
    private $db_pass1;
    private $pdo;

    public function __construct($db_host, $db_name, $db_user, $db_pass)
    {
        $this->db_host1 = $db_host;
        $this->db_name1 = $db_name;
        $this->db_user1 = $db_user;
        $this->db_pass1 = $db_pass;
    }

    private function getPDO()
    {
        if ($this->pdo === null) {
            $pdo = new PDO('mysql:host='.$this->db_host1.'; dbname='.$this->db_name1, $this->db_user1, $this->db_pass1);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }

        return $this->pdo;
    }

    /*recupere les informations lorsque la requete n'est pas dans une class spécifique EX: portfolio, home, etc...
        public function query($statement){
            $req = $this->getPDO()->query($statement);
            $donnee = $req->fetchAll(PDO::FETCH_OBJ);
          return $donnee;
        }*/

    // Récupère les informations lorsque la requete est dans une class spécifique EX: affiche_menu()
    public function query($statement, $class_name = null, $one = false)
    {
        $req = $this->getPDO()->query($statement);
        //$donnee = $req->fetchAll(PDO::FETCH_CLASS, $class_name );
        if (is_null($class_name)) {
            $req->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }

        if ($one) {
            $donnee = $req->fetch();
        } else {
            $donnee = $req->fetchAll();
        }

        return $donnee;
    }

    public function prepare($statement, $attributes, $class_name, $one = false)
    {
        $req = $this->getPDO()->prepare($statement);
        $req->execute($attributes);
        $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        if ($one) {
            $donnee = $req->fetch();
        } else {
            $donnee = $req->fetchAll();
        }

        return $donnee;
    }

    public function prepare_request($statement, $attributes)
    {
        $req = $this->getPDO()->prepare($statement);
        $req->execute($attributes);
        $donnee = $req->fetch();

        return $donnee;
    }

    //combinaison de query et prepare pour optimiser les rêquetes
    public static function query_OR_prepare($statement, $attributes = null, $one = false)
    {
        //methode 1
        /* if($attributes)
         {
             return \App::getPDO()->prepare($statement, $attributes, get_called_class(), $one);
         }
         else
         {
          return \App::getPDO()->queryclass($statement, get_called_class(), $one);
         }*/

        //methode 2
        return ($attributes) ? \App::getPDO()->prepare($statement, $attributes, get_called_class(), $one) : \App::getPDO()->queryclass($statement, get_called_class(), $one);
    }

    //INSERTION D'INFORMATIONS DANS BD
    public function insert($statement, $attributes)
    {
        $insertion = $this->getPDO()->prepare($statement);
        $insertion->execute($attributes);
    }

    //MODIFICATION D'INFORMATIONS DANS BD
    public function update($statement, $attributes)
    {
        $miseAjour = $this->getPDO()->prepare($statement);
        $miseAjour->execute($attributes);
    }

    //SUPPRESSION D'INFORMATIONS DANS BD
    public function delete($statement, $attributes)
    {
        $delete = $this->getPDO()->prepare($statement);
        $delete->execute($attributes);
    }

    //RENVOI LE NOMBRE DE LIGNES D'UNE TABLE OU PLUSIEURS TABLES
    public function rowCount($statement)
    {
        $req = $this->getPDO()->query($statement);
        $donnee = $req->rowCount();

        return $donnee;
    }

    public function compteur_start_end($statement)
    {
        $req = $this->getPDO()->prepare($statement);

        return $req;
    }

    // Récupère les informations dans sous forme de tableau associatif
    public function getTabAssociatif($statement)
    {
        $req = $this->getPDO()->query($statement);

        return $req;
    }
}
