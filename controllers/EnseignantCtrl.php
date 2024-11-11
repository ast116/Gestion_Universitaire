<?php
require_once("../models/EnseignantS.php");

$ens = new EnseignantS();

if (isset($_GET['action']))
    $action = $_GET['action'];
if (isset($_POST['action']))
    $action = $_POST['action'];


if ($action == 'ajout') {
    //recuperation donnee
    $nom = $_POST['nom'];
    $class = $_POST['class'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];

    //appel du model
    $ens->add($nom, $class, $email, $tel);

    //appel de la vue
    Header('Location:../views/Enseignant/enseignant.php');
}

if ($action == 'listen') {
    Header('Location:../views/Enseignant/listen.php');
}


if ($action == 'enseignant') {
    Header('Location:../views/Enseignant/enseignant.php');
}


if ($action == 'edite') {
    $ide = $_GET['ide'];
    Header('Location:../views/Enseignant/edite.php?ide=' . $ide);
}

if ($action == 'delete') {
    $ide = $_GET['ide'];
    $ens->delete($ide);
    Header('Location:../views/Enseignant/listen.php?message=Etudiant supprimé');
}


if ($action == 'modifier') {

    $ide = $_POST['ide'];
    $nom = $_POST['nom'];
    $class = $_POST['class'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];

    $ens->edit($ide, $nom, $class, $email, $tel);

    Header('Location:../views/Enseignant/listen.php?message=Enseignant modifier');
}
