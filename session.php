<?php

require '../Authent/config.php';

session_start();
if (!isset($_SESSION['user'])) {
    header("Location:../Authent/check_login.php");
    exit();
}

$sql = "SELECT 
            enseignants.nom AS nom_enseignant,
            etudiants.nom AS nom_etudiant,
            etudiants.matricule AS matricule_etudiant,
            enseignants.tel AS telephone_enseignant,
            etudiants.class AS nom_classe,
            salles.salle AS nom_salle
        FROM 
            enseignant AS enseignants
        INNER JOIN 
            etudiant AS etudiants ON enseignants.class = etudiants.class
        INNER JOIN 
            salle AS salles ON enseignants.class = salles.class
        ORDER BY 
            enseignants.class ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$sessions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Session</title>
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
    <script type="text/javascript" src="../../js/jquery.js"></script>
    <script type="text/javascript" src="../../js/bootstrap.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <nav class="navbar navbar-inverse" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
                            <span class="sr-only">Accueil</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="example-navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="../Etudiant/etudiants.php">Étudiant</a></li>
                            <li><a href="../Enseignant/enseignant.php">Enseignant</a></li>
                            <li><a href="../Salle/salle.php">Cours</a></li>
                            <li class="active"><a href="../Session/session.php">Session</a></li>
                            <li><a href="../Authent/logout.php" style="color: red;">Déconnexion</a></li>
                        </ul>
                    </div>
                </nav>

                <br><br><br>

                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr class="info">
                            <th>Enseignant</th>
                            <th>Étudiant</th>
                            <th>Classe</th>
                            <th>Salle</th>
                            <th>Matricule Étudiant</th>
                            <th>Tél Enseignant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sessions as $session): ?>
                            <tr>
                                <td><?php echo ($session['nom_enseignant']); ?></td>
                                <td><?php echo ($session['nom_etudiant']); ?></td>
                                <td><?php echo ($session['nom_classe']); ?></td>
                                <td><?php echo ($session['nom_salle']); ?></td>
                                <td><?php echo ($session['matricule_etudiant']); ?></td>
                                <td><?php echo ($session['telephone_enseignant']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>