<?php

if (isset($_SESSION['erreur'])) {
    $erreur = $_SESSION['erreur'];
} else {
    $erreur = '';
}
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

        <h1>Connectez-vous</h1>
        <br><br>
        <form action="traitement.php" method="post" class="cnx" ">
        <label>Votre identifiant (nom.prénom)</label><br>
        <input type=" text" placeholder="Login" name="login"><br>
            <label>Votre mot de passe</label><br>
            <input type="password" name="password" placeholder="Mot de passe"><br><br>

            <br><input type="submit" value="Connexion">
            <br><br><a href="./reset-password.php" style="text-decoration:none; color:red; font-size:large">Mot de passe oublié !!!</a>
        </form>

        <div class="erreur">
            <?php

            echo $erreur;
            ?>

        </div>
        <div class="espace">

        </div>
    </div>
    <?php include './php/menu/footer.php' ?>
</body>

</html>