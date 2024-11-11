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

require_once("../../models/EtudiantS.php");
$idet = isset($_GET['idet']) ? $_GET['idet'] : null;

$ets = new EtudiantS();
$etudiants = $ets->getAll();

// Si 'idet' est défini, récupère les informations de l'étudiant
$etudiant = $idet ? $ets->getI($idet) : null;
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
                            <li class="active"><a href="#">Etudiant</a></li>
                            <li><a href="../Enseignant/enseignant.php">Enseignant</a></li>
                            <li><a href="../Salle/salle.php">Cours</a></li>
                            <li><a href="../Session/session.php">Session</a></li>
                            <li> <a href="../Authent/logout.php" style="color: red;">Deconnexion</a></li>
                            <li></li>

                        </ul>
                    </div>
                </nav>
                <br>

                <a href="../../controllers/EtudiantCtrl.php?action=liste">Liens de Modification Etudiant</a> <br>

                <br>
                <button class="btn btn-success pull-left" data-toggle="modal" data-target="#ajout">Ajouter Etudiant</button>
                <br><br>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr class="info">
                            <th>Id</th>
                            <th>Matricule</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Classe</th>
                            <th>Email</th>
                            <th>Statut</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($etudiants as $et) {
                        ?>
                            <tr>
                                <td><?php echo $et['idet']; ?></td>
                                <td><?php echo $et['matricule']; ?></td>
                                <td><?php echo $et['nom']; ?></td>
                                <td><?php echo $et['prenom']; ?></td>
                                <td><?php echo $et['class']; ?></td>
                                <td><?php echo $et['email']; ?></td>
                                <td><?php echo $et['statut']; ?></td>
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
                                Enregistrement Etudiant
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="../../controllers/EtudiantCtrl.php" method="post">
                                    Matricule:
                                    <input type="text" name="matricule" class="form-control" required placeholder="Entrer la Matricule" autocomplete="off"><br>Nom:
                                    <input type="text" name="nom" class="form-control" required placeholder="Entrer le Nom" autocomplete="off">
                                    <br>Prenom:
                                    <input type="text" name="prenom" class="form-control" required placeholder="Entrer le Prenom">
                                    <br>La classe:
                                    <select id="classe" required class="form-control" name="class">
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="L3">L3</option>
                                        <option value="M1">M1</option>
                                        <option value="M2">M2</option>
                                    </select>
                                    <br>Email:
                                    <input type="email" name="email" class="form-control" required placeholder="Entrer l'Email" autocomplete="off">

                                    Statue:
                                    <select id="statut" required class="form-control" name="statut">
                                        <option value="Actif">Actif</option>
                                        <option value="Inactif">Inactif</option>
                                    </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="hidden" name="action" value="ajout">
                                    <button type="submit" value="enregistrer" class="btn btn-primary btn-block"><i class="glyphicon glyphicon-pencil"></i> Inscription</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin modale ajout-->

                <!-- Modale Modification-->
                <div class="modal fade" tabindex="-1" role="dialog" id="modifier" aria-hidden="true" aria-labelledby="modifier">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                Modification Etudiant
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="../../controllers/EtudiantCtrl.php" method="post">
                                    <!-- Champ caché pour l'identifiant de l'étudiant -->
                                    <input type="hidden" name="idet" value="<?php echo $etudiant ? $etudiant['idet'] : ''; ?>">

                                    Matricule:
                                    <input type="text" name="matricule" class="form-control" required placeholder="Entrer la Matricule"
                                        value="<?php echo $etudiant ? $etudiant['matricule'] : ''; ?>" autocomplete="off"><br>

                                    Nom:
                                    <input type="text" name="nom" class="form-control" required placeholder="Entrer le Nom"
                                        value="<?php echo $etudiant ? $etudiant['nom'] : ''; ?>" autocomplete="off"><br>

                                    Prenom:
                                    <input type="text" name="prenom" class="form-control" required placeholder="Entrer le Prenom"
                                        value="<?php echo $etudiant ? $etudiant['prenom'] : ''; ?>"><br>

                                    La classe:
                                    <select id="classe" required class="form-control" name="class">
                                        <option value="L1" <?php echo $etudiant && $etudiant['class'] == 'L1' ? 'selected' : ''; ?>>L1</option>
                                        <option value="L2" <?php echo $etudiant && $etudiant['class'] == 'L2' ? 'selected' : ''; ?>>L2</option>
                                        <option value="L3" <?php echo $etudiant && $etudiant['class'] == 'L3' ? 'selected' : ''; ?>>L3</option>
                                        <option value="M1" <?php echo $etudiant && $etudiant['class'] == 'M1' ? 'selected' : ''; ?>>M1</option>
                                        <option value="M2" <?php echo $etudiant && $etudiant['class'] == 'M2' ? 'selected' : ''; ?>>M2</option>
                                    </select><br>

                                    Email:
                                    <input type="email" name="email" class="form-control" required placeholder="Entrer l'Email"
                                        value="<?php echo $etudiant ? $etudiant['email'] : ''; ?>" autocomplete="off"><br>

                                    Statue:
                                    <select id="statut" required class="form-control" name="statut">
                                        <option value="Actif" <?php echo $etudiant && $etudiant['statut'] == 'Actif' ? 'selected' : ''; ?>>Actif</option>
                                        <option value="Inactif" <?php echo $etudiant && $etudiant['statut'] == 'Inactif' ? 'selected' : ''; ?>>Inactif</option>
                                    </select><br>

                                    <!-- Bouton de soumission -->
                                    <input type="hidden" name="action" value="modifier">
                                    <button type="submit" value="enregistrer" class="btn btn-primary btn-block">
                                        <i class="glyphicon glyphicon-pencil"></i> Modifier
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin modale modification -->



                <script>
                    function openEditModal(idet) {
                        // Modifie l'input caché de la modale pour y mettre l'ID de l'étudiant
                        document.querySelector('#modifier input[name="idet"]').value = idet;
                        // Affiche la modale
                        $('#modifier').modal('show');
                    }
                </script>