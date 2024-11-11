<?php
require_once("Provider.php");

class EtudiantS
{
    private $connexion;

    function __construct()
    {
        $p = new Provider();
        $this->connexion = $p->getconnexion();
    }

    public function addE($matricule, $nom, $prenom, $class, $email, $statut)
    {
        $requete = "INSERT INTO etudiant(matricule, nom, prenom, class, email, statut) VALUES(:mt, :nm, :pr, :cl, :em, :st)";
        $r = $this->connexion->prepare($requete);
        $stat = $r->execute([
            ':mt' => $matricule,
            ':nm' => $nom,
            ':pr'  => $prenom,
            ':cl'  => $class,
            ':em'  => $email,
            ':st' => $statut
        ]);
    }

    public function getAll()
    {
        $requete = "select * from etudiant order by idet asc ";
        $r = $this->connexion->query($requete);
        $etudiants = $r->fetchAll(PDO::FETCH_ASSOC);
        return $etudiants;
    }

    public function edit($idet, $matricule, $nom, $prenom, $class, $email, $statut)
    {
        $requete = "UPDATE etudiant set matricule=:mt, nom=:nm, prenom=:pr, class=:cl, email=:em, statut=:st where idet=:id";
        $r = $this->connexion->prepare($requete);
        $stat = $r->execute([
            ':mt' => $matricule,
            ':nm' => $nom,
            ':pr'  => $prenom,
            ':cl'  => $class,
            ':em'  => $email,
            ':st' => $statut,
            ':id' => $idet
        ]);
    }

    public function getI($idet)
    {
        $requete = "SELECT *FROM etudiant where idet=:id";
        $r = $this->connexion->prepare($requete);
        $stat = $r->execute([
            'id' => $idet
        ]);
        $etudiant = $r->fetchAll(PDO::FETCH_ASSOC);
        return $etudiant[0];
    }

    public function delete($idet)
    {

        $requete = 'DELETE from etudiant where idet=:id';
        $r = $this->connexion->prepare($requete);
        $stat = $r->execute([
            ':id' => $idet
        ]);
    }
}
