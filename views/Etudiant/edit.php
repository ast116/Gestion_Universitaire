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
    <title>Modification</title>
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
    <script type="text/javascript" src="../../js/jquery.js"></script>
    <script type="text/javascript" src="../../js/bootstrap.js"></script>
</head>

<body>
    <style>

    </style>
    <?php
    $idet = $_GET["idet"];
    require_once('../../models/EtudiantS.php');
    $ets = new EtudiantS();
    $etudiant = $ets->getI($idet);
    ?>
    <h1>Modification Etudiant</h1>
    <div class="container text-center">
        <button class="btn btn-primary pull-left" data-toggle="modal" data-target="#modifier">Modifier Etudiant</button>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="modifier" aria-hidden="true" aria-labelledby="modifier">
        <div class="modal-dialog modal-dialog-centered" role="document">
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
                            value="<?php echo  $etudiant['matricule']; ?>" autocomplete="off"><br>

                        Nom:
                        <input type="text" name="nom" class="form-control" required placeholder="Entrer le Nom"
                            value="<?php echo $etudiant['nom']; ?>" autocomplete="off"><br>

                        Prenom:
                        <input type="text" name="prenom" class="form-control" required placeholder="Entrer le Prenom"
                            value="<?php echo $etudiant['prenom']; ?>"><br>

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

</body>

</html>