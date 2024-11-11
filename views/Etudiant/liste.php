<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location:../Authent/check_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste</title>
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
    <script type="text/javascript" src="../../js/jquery.js"></script>
    <script type="text/javascript" src="../../js/bootstrap.js"></script>

</head>

<body>
    <h1> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Liste Etudiant</h1>

    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;

    <a href="../../controllers/EtudiantCtrl.php?action=etudiants">Allez vers menu Etudiant</a><br>
    <?php

    require_once('../../models/EtudiantS.php');
    $ets = new EtudiantS();
    $etudiants = $ets->getAll();

    ?>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered table-striped table-hover" align="center">
                    <thead>
                        <tr class="info">
                            <th>Id</th>
                            <th>Matricule</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Classe</th>
                            <th>Email</th>
                            <th>Statut</th>
                            <th>Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($etudiants as $et) {
                        ?>
                            <tr class="warning">
                                <td><?php echo $et['idet']; ?></td>
                                <td><?php echo $et['matricule']; ?></td>
                                <td><?php echo $et['nom']; ?></td>
                                <td><?php echo $et['prenom']; ?></td>
                                <td><?php echo $et['class']; ?></td>
                                <td><?php echo $et['email']; ?></td>
                                <td><?php echo $et['statut']; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-cog"></i> Menu <span class="caret"></span></button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="../../controllers/EtudiantCtrl.php?action=edit&idet=<?php echo $et['idet'] ?>">Modifier</a></li>
                                            <li> <a href="../../controllers/EtudiantCtrl.php?action=delete&idet=<?php echo $et['idet']; ?>" onClick="return window.confirm('Etes-vous sûre de vouloir supprimer cet étudiant')" style="color: red;">Supprimer</a></li>
                                            <!--<li> <a href="delete.php?delete=" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce prisonnier ?');">Supprimer</a></li>-->
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <form action="../../controllers/EtudiantCtrl.php" method="GET" id="f1"></form>
            </div>
</body>

</html>