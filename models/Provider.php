<?php

class Provider
{
    private $host = 'localhost';
    private $dbName = "School";
    private $user = "root";
    private $password = "";

    public function getconnexion()
    {
        $con = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->user, $this->password);
        if ($con) {
            // echo "connexion etablie";
            return $con;
        } else {
            // echo "echec de connexion";
            return null;
        }
    }
}

$p = new Provider();
$p->getconnexion();
