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
    <?php
    $ide = $_GET["ide"];
    require_once('../../models/EnseignantS.php');
    $ens = new EnseignantS();
    $enseignant = $ens->getIde($ide);
    ?>
    <h1>Modification Enseignant</h1>
    <div class="container text-center">
        <button class="btn btn-primary pull-left" data-toggle="modal" data-target="#modifier">Modifier Enseignant</button>

    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modifier" aria-hidden="true" aria-labelledby="modifier">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Modification Etudiant
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="../../controllers/EnseignantCtrl.php" method="post">

                        <!-- Champ caché pour l'identifiant de l'étudiant -->
                        <input type="hidden" name="ide" value="<?php echo $enseignant ? $enseignant['ide'] : ''; ?>">

                        Nom & Prenom:
                        <input type="text" name="nom" class="form-control" required placeholder="Entrer le Nom & Prenom"
                            value="<?php echo  $enseignant['nom']; ?>" autocomplete="off"><br>

                        La classe:
                        <select id="classe" required class="form-control" name="class">
                            <option value="L1" <?php echo $enseignant && $enseignant['class'] == 'L1' ? 'selected' : ''; ?>>L1</option>
                            <option value="L2" <?php echo $enseignant && $enseignant['class'] == 'L2' ? 'selected' : ''; ?>>L2</option>
                            <option value="L3" <?php echo $enseignant && $enseignant['class'] == 'L3' ? 'selected' : ''; ?>>L3</option>
                            <option value="M1" <?php echo $enseignant && $enseignant['class'] == 'M1' ? 'selected' : ''; ?>>M1</option>
                            <option value="M2" <?php echo $enseignant && $enseignant['class'] == 'M2' ? 'selected' : ''; ?>>M2</option>
                        </select><br>

                        Email:
                        <input type="email" name="email" class="form-control" required placeholder="Entrer l'Email"
                            value="<?php echo $enseignant ? $enseignant['email'] : ''; ?>" autocomplete="off"><br>

                        Telephone:
                        <input type="number" name="tel" class="form-control" required placeholder="Entrer le Numero"
                            value="<?php echo  $enseignant['tel']; ?>" autocomplete="off"><br>

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