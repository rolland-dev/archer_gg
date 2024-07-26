<?php

require_once "../../php/bdd/protection.php";

if (isset($_POST['submit'])) {

    if (isset($_POST['nom'])) {
        $nom = $_POST['nom'];
    } else {
        $_SESSION['erreur'] .= 'champ nom vide';
        header('location: ./create_user.php');
        exit();
    }
    if (isset($_POST['prenom'])) {
        $prenom = $_POST['prenom'];
    } else {
        $_SESSION['erreur'] .= 'champ prenom vide';
        header('location: ./create_user.php');
        exit();
    }

    if (isset($_POST['date'])) {
        $date = $_POST['date'];
    } else {
        $_SESSION['erreur'] .= 'champ date vide';
        header('location: ./create_user.php');
        exit();
    }
    if (isset($_POST['categorie'])) {
        $categorie = $_POST['categorie'];
    } else {
        $_SESSION['erreur'] .= 'champ categorie vide';
        header('location: ./create_user.php');
        exit();
    }

    if (isset($_POST['groupe'])) {
        $groupe = $_POST['groupe'];
    } else {
        $_SESSION['erreur'] .= 'champ groupe vide';
        header('location: ./create_user.php');
        exit();
    }
    require_once "../../php/bdd/config.php";

    $nom = protect_montexte($nom);
    $prenom = protect_montexte($prenom);
    $date = protect_montexte($date);
    $categorie = protect_montexte($categorie);
    $groupe = protect_montexte($groupe);

    $sql = "INSERT INTO inscriptions (nom,prenom, date, categorie, groupe) VALUES (?,?, ?,?,?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssssi", $param_nom, $param_prenom, $param_date, $param_categorie, $param_groupe);

        $param_nom = $nom;
        $param_prenom = $prenom;
        $param_date = $date;
        $param_categorie = $categorie;
        $param_groupe = $groupe;

            if (mysqli_stmt_execute($stmt)) {
                header("location: ../concours_admin.php");
                exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once '../../php/menu/head.php' ?>
    <title>Login</title>
</head>

<body>

    <div class="text-center">

        <h1>Creation d'un archer pour concours</h1><br><br>

        <form method="post" class="cnx">
            <label>Nom</label><br>
            <input type="text" placeholder="nom" name="nom"><br><br>
            <label>Prénom</label><br>
            <input type="text" placeholder="prenom" name="prenom"><br><br>
            <label>Date</label><br>
            <input type="date" placeholder="date" name="date"><br><br>
            <label>Catégorie</label><br>
            <input type="text" name="categorie" placeholder="categorie"><br>
            <label>(Classique / Visseur / Poulie / chasse / droit...)</label><br><br>
            <label>Groupe</label><br>
            <input type="number" name="groupe" placeholder="groupe"><br>
            <label>(numéro du groupe : 1, 2, 3...)</label><br><br>
            <input type="submit" name="submit" value="Créer" class="btn btn-secondary ml-2">
            <a href="../concours_admin.php" class="btn btn-secondary ml-2">Annuler</a>
        </form>

        <div class="espace">

        </div>
    </div>
    <!-- <?php include './php/menu/footer.php' ?> -->
</body>

</html>