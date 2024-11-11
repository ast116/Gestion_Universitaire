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
require_once('../../models/SalleS.php');

$sal = new SalleS();
$salles = $sal->getalls();

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
                            <li><a href="../Enseignant/enseignant.php">Enseignant</a></li>
                            <li class="active"><a href="../Salle/salle.php">Cours</a></li>
                            <li><a href="../Session/session.php">Session</a></li>
                            <li> <a href="../Authent/logout.php" style="color: red;">Deconnexion</a></li>

                        </ul>
                    </div>
                </nav>
                <br><br>
                <div class="col-sm-10">
                    <div class="col-sm-10">
                        <button class="btn btn-primary pull-left" data-toggle="modal" data-target="#ajout">Ajouter Salle</button>
                        <br><br><br>
                        <table class="table table-bordered table-striped table-hover" border="1">
                            <thead>
                                <tr class="warning">
                                    <th>Ids</th>
                                    <th>Salle</th>
                                    <th>Classe</th>
                                    <th>Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($salles as $sl) {
                                ?>
                                    <tr class="info">
                                        <td><?php echo $sl['ids']; ?></td>
                                        <td><?php echo $sl['salle']; ?></td>
                                        <td><?php echo $sl['class']; ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-cog"></i> Menu <span class="caret"></span></button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li> <a href="../../controllers/SalleCtrl.php?action=deletes&ids=<?php echo $sl['ids']; ?>" onClick="return window.confirm('Etes-vous sûre de vouloir supprimer cet étudiant')">Supprimer</a></li>
                                                </ul>

                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>



                <!-- Modale AjoutEtudiant-->
                <div class="modal fade" tabindex="-1" role="dialog" id="ajout" aria-hidden="true" labelledby="ajout">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                Enregistrement De Salle
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="../../controllers/SalleCtrl.php" method="post">
                                    Numero de Salle:
                                    <select id="salle" required class="form-control" name="salle">
                                        <option value="Salle1">Salle1</option>
                                        <option value="Salle2">Salle2</option>
                                        <option value="Salle3">Salle3</option>
                                        <option value="Salle4">Salle4</option>
                                        <option value="Salle5">Salle5</option>
                                    </select><br>
                                    La Classe:
                                    <select id="classe" required class="form-control" name="class">
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="L3">L3</option>
                                        <option value="M1">M1</option>
                                        <option value="M2">M2</option>
                                    </select><br>
                                    <input type="hidden" name="action" value="ajout">
                                    <button type="submit" value="enregistrer" class="btn btn-primary btn-block"><i class="glyphicon glyphicon-pencil"></i> Inscription</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin modale ajout-->