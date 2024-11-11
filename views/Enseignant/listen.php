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
    <h1> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Liste Enseignant</h1>

    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;

    <a href="../../controllers/EnseignantCtrl.php?action=enseignant">Allez vers menu Enseignant</a><br>
    <?php

    require_once('../../models/EnseignantS.php');
    $ens = new EnseignantS();
    $enseignants = $ens->getall();

    ?>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered table-striped table-hover" align="center">
                    <thead>
                        <tr class="info">
                            <th>Ide</th>
                            <th>Nom_Prenom</th>
                            <th>Matiere</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($enseignants as $en) {
                        ?>
                            <tr class="warning">
                                <td><?php echo $en['ide']; ?></td>
                                <td><?php echo $en['nom']; ?></td>
                                <td><?php echo $en['class']; ?></td>
                                <td><?php echo $en['email']; ?></td>
                                <td><?php echo $en['tel']; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-cog"></i> Menu <span class="caret"></span></button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="../../controllers/EnseignantCtrl.php?action=edite&ide=<?php echo $en['ide'] ?>">Modifier</a></li>
                                            <li> <a href="../../controllers/EnseignantCtrl.php?action=delete&ide=<?php echo $en['ide']; ?>" onClick="return window.confirm('Etes-vous sûre de vouloir supprimer cet étudiant')" style="color: red;">Supprimer</a></li>
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
                <form action="../../controllers/EnseignantCtrl.php" method="GET" id="f1"></form>
            </div>
</body>

</html>