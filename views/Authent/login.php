<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];


    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();

    if ($user) {

        if (password_verify($mot_de_passe, $user['mot_de_passe'])) {

            $_SESSION['user'] = $email;
            header("Location: ../Etudiant/etudiants.php");
            exit();
        } else {

            $error = "Mot de passe incorrect.";
        }
    } else {
        // L'utilisateur n'existe pas, l'enregistrer comme nouvel utilisateur

        $stmt = $pdo->prepare("INSERT INTO utilisateurs (email, mot_de_passe) VALUES (:email, :mot_de_passe)");
        $stmt->execute([
            ':email' => $email,
            ':mot_de_passe' => password_hash($mot_de_passe, PASSWORD_DEFAULT), // Hachage du mot de passe
        ]);

        // Enregistrement dans la session
        $_SESSION['user'] = $email;
        header("Location: ../Etudiant/etudiants.php"); // Redirection vers la page étudiante
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
    <script type="text/javascript" src='../../js/jquery.js'></script>
    <script type="text/javascript" src='../../js/bootstrap.js'></script>
    <title>Connexion</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-7 col-md-offset-2">
                <div class="row" style="padding: 200px 100px 19px 100px;">
                    <form role="form-horizontal" method="POST" action="login.php">
                        <div class="form-group">
                            <label class="col-sm-3 label-control" for="email">E-mail</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </span>
                                <input type="email" class="form-control" required placeholder="E-mail" name="email" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 label-control" for="mot_de_passe">Mot de passe</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-lock"></span>
                                </span>
                                <input type="password" class="form-control" required placeholder="Mot de passe" name="mot_de_passe" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3"></div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-log-out"></span>
                                </span>
                                <button class="btn btn-primary btn-block" type="submit">Connexion <i class="glyphicon glyphicon-check"></i></button>
                            </div>
                        </div>
                    </form>
                    <?php if (isset($error)): ?>
                        <p class="text-danger"><?= $error ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>