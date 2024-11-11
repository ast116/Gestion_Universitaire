<?php
require_once("../models/EtudiantS.php");

$ets = new EtudiantS();

if (isset($_GET['action']))
    $action = $_GET['action'];
if (isset($_POST['action']))
    $action = $_POST['action'];


if ($action == 'ajout') {
    //recuperation donnee
    $matricule = $_POST['matricule'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $class = $_POST['class'];
    $email = $_POST['email'];
    $statut = $_POST['statut'];

    //appel du model
    $ets->addE($matricule, $nom, $prenom, $class, $email, $statut);

    //appel de la vue
    Header('Location:../views/Etudiant/etudiants.php');
}

if ($action == 'liste') {
    Header('Location:../views/Etudiant/liste.php');
}


if ($action == 'etudiants') {
    Header('Location:../views/Etudiant/etudiants.php');
}


if ($action == 'edit') {
    $idet = $_GET['idet'];
    Header('Location:../views/Etudiant/edit.php?idet=' . $idet);
}

if ($action == 'delete') {
    $idet = $_GET['idet'];
    $ets->delete($idet);
    Header('Location:../views/Etudiant/liste.php?message=Etudiant supprimé');
}


if ($action == 'modifier') {

    $idet = $_POST['idet'];
    $matricule = $_POST['matricule'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $class = $_POST['class'];
    $email = $_POST['email'];
    $statut = $_POST['statut'];

    $ets->edit($idet, $matricule, $nom, $prenom, $class, $email, $statut);

    Header('Location:../views/Etudiant/liste.php?message=Etudiant Modifie');
}
