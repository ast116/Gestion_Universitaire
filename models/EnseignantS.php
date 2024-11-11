<?php
require_once("Provider.php");

class EnseignantS
{
    private $connexion;

    function __construct()
    {
        $t = new Provider();
        $this->connexion = $t->getconnexion();
    }

    public function add($nom, $class, $email, $tel)
    {
        $requete = "INSERT INTO enseignant(nom, class, email, tel) VALUES(:nm, :cl, :em, :tl)";
        $r = $this->connexion->prepare($requete);
        $stat = $r->execute([
            ':nm' => $nom,
            ':cl' => $class,
            ':em'  => $email,
            ':tl'  => $tel

        ]);
    }

    public function getall()
    {
        $requete = "select * from enseignant order by ide asc ";
        $r = $this->connexion->query($requete);
        $enseignants = $r->fetchAll(PDO::FETCH_ASSOC);
        return $enseignants;
    }

    public function edit($ide, $nom, $class, $email, $tel)
    {
        $requete = "UPDATE enseignant set  nom=:nm, class=:cl, email=:em, tel=:tl where ide=:id";
        $r = $this->connexion->prepare($requete);
        $stat = $r->execute([
            ':nm' => $nom,
            ':cl'  => $class,
            ':em'  => $email,
            ':tl' => $tel,
            ':id' => $ide
        ]);
    }

    public function getIde($ide)
    {
        $requete = "SELECT *FROM enseignant where ide=:id";
        $r = $this->connexion->prepare($requete);
        $stat = $r->execute([
            'id' => $ide
        ]);
        $enseignant = $r->fetchAll(PDO::FETCH_ASSOC);
        return $enseignant[0];
    }

    public function delete($ide)
    {

        $requete = 'DELETE from enseignant where ide=:id';
        $r = $this->connexion->prepare($requete);
        $stat = $r->execute([
            ':id' => $ide
        ]);
    }
}
