<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location:../Authent/check_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GC</title>
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
    <script type="text/javascript" src="../../js/jquery.js"></script>
    <script type="text/javascript" src="../../js/bootstrap.js"></script>

</head>
<?php
require_once('../../models/EnseignantS.php');

$ens = new EnseignantS();
$enseignants = $ens->getall();

?>



<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <nav class="navbar navbar-inverse" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
                            <span class="sr-only">ACCEUIL</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                    </div>
                    <div class="collapse navbar-collapse" id="example-navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="../Etudiant/etudiants.php">Etudiant</a></li>
                            <li class="active"><a href="../Enseignant/enseignant.php">Enseignant</a></li>
                            <li><a href="../Salle/salle.php">Cours</a></li>
                            <li><a href="../Session/session.php">Session</a></li>
                            <li> <a href="../Authent/logout.php" style="color: red;">Deconnexion</a></li>
                            <li></li>

                        </ul>
                    </div>
                </nav>
                <br>
                <a href="../../controllers/EnseignantCtrl.php?action=listen">Liens Modification Enseigants Present</a> <br>
                <br>
                <button class="btn btn-success pull-left" data-toggle="modal" data-target="#ajout">Ajouter Enseignant</button>
                <br><br>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr class="info">
                            <th>Ide</th>
                            <th>Nom_Prenom</th>
                            <th>Classe</th>
                            <th>Email</th>
                            <th>Telephone</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($enseignants as $en) {
                        ?>
                            <tr>
                                <td><?php echo $en['ide']; ?></td>
                                <td><?php echo $en['nom']; ?></td>
                                <td><?php echo $en['class']; ?></td>
                                <td><?php echo $en['email']; ?></td>
                                <td><?php echo $en['tel']; ?></td>

                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>


                <!-- Modale AjoutEtudiant-->
                <div class="modal fade" tabindex="-1" role="dialog" id="ajout" aria-hidden="true" labelledby="ajout">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                Enregistrement Enseignant
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="../../controllers/EnseignantCtrl.php" method="post">
                                    Nom & Prenom:
                                    <input type="text" name="nom" class="form-control" required placeholder="Entrer le Nom & Prenom" autocomplete="off"><br>
                                    La classe:
                                    <select id="classe" required class="form-control" name="class">
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="L3">L3</option>
                                        <option value="M1">M1</option>
                                        <option value="M2">M2</option>
                                    </select><br>
                                    Email:
                                    <input type="email" name="email" class="form-control" required placeholder="Entrer l'Email" autocomplete="off"><br>
                                    Tel:
                                    <input type="number" name="tel" class="form-control" required placeholder="Entrer le numero">
                                    <br>
                                    <input type="hidden" name="action" value="ajout">
                                    <button type="submit" value="enregistrer" class="btn btn-primary btn-block"><i class="glyphicon glyphicon-pencil"></i> Inscription</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin modale ajout-->