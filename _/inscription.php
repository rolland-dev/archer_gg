<?php
session_start();
$msg_erreur="";

if (isset($_SESSION['msg_erreur'])) {
    $msg_erreur = $_SESSION['msg_erreur'];
} else {
    $msg_erreur = "";
}

session_abort();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './php/menu/head.php' ?>
    <title>Login</title>
</head>

<body>

    <?php include './php/menu/menu.php' ?>

    <div class="text-center">

        <h1>Inscrivez vous !!</h1><br><br>
        <h2><?= $msg_erreur ?></h2>
        <form action="./inscrit.php" method="post" class="cnx">
            <label>Votre 'nom.prénom'</label><br>
            <input type="text" placeholder="nom.prénom" name="pseudo"><br><br>
            <label>Votre email (donné à l'inscription)</label><br>
            <input type="text" placeholder="email" name="email"><br><br>
            <label>Votre mot de passe</label><br>
            <input type="password" name="password" placeholder="Mot de passe"><br><br>
            <input type="checkbox" name="cgu" id="cgu"><br>
            <label for="cgu">Je reconnais avoir lu et compris les CGU et je les accepte.</label><br><br>
            <input type="submit" value="Inscription">
        </form>

        <div class="espace">

        </div>
    </div>
    <?php include './php/menu/footer.php' ?>
</body>

</html>