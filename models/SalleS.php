<?php
require_once("Provider.php");

class SalleS
{
    private $connexion;

    function __construct()
    {
        $u = new Provider();
        $this->connexion = $u->getconnexion();
    }

    public function adds($salle, $class)
    {
        $requete = "INSERT INTO salle(salle,class) VALUES(:sl, :cl)";
        $r = $this->connexion->prepare($requete);
        $stat = $r->execute([
            ':sl' => $salle,
            ':cl' => $class

        ]);
    }

    public function getalls()
    {
        $requete = "select * from salle order by ids asc ";
        $r = $this->connexion->query($requete);
        $salles = $r->fetchAll(PDO::FETCH_ASSOC);
        return $salles;
    }

    public function getIds($ids)
    {
        $requete = "SELECT *FROM salle where ids=:id";
        $r = $this->connexion->prepare($requete);
        $stat = $r->execute([
            ':id' => $ids
        ]);
        $salle = $r->fetchAll(PDO::FETCH_ASSOC);
        return $salle[0];
    }

    public function deletes($ids)
    {

        $requete = 'DELETE from salle where ids=:id';
        $r = $this->connexion->prepare($requete);
        $stat = $r->execute([
            ':id' => $ids
        ]);
    }
}
