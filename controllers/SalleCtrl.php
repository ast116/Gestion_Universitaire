<?php

require_once("../models/SalleS.php");

$sal = new SalleS();

if (isset($_GET['action']))
    $action = $_GET['action'];
if (isset($_POST['action']))
    $action = $_POST['action'];

if ($action == 'ajout') {

    $salle = $_POST['salle'];
    $class = $_POST['class'];

    $sal->adds($salle, $class);

    Header('Location:../views/Salle/salle.php');
}


if ($action == 'deletes') {
    $ids = $_GET['ids'];
    $sal->deletes($ids);
    Header('Location:../views/Salle/salle.php?message=Etudiant supprimé');
}
