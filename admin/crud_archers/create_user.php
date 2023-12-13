<?php

require_once "../../php/bdd/protection.php";

$nom = $_GET['nom'];
$prenom = $_GET['prenom'];

if (isset($_POST['submit'])) {

    if (isset($_POST['pseudo'])) {
        $pseudo = $_POST['pseudo'];
    } else {
        $_SESSION['erreur'] .= 'champ pseudo vide';
        header('location: ./create_user.php');
        exit();
    }
    if (isset($_POST['role'])) {
        $role = $_POST['role'];
    } else {
        $_SESSION['erreur'] .= 'champ passeword vide';
        header('location: ./create_user.php');
        exit();
    }

    require_once "../../php/bdd/config.php";

    $login_ok = protect_montexte($pseudo);
    $role_ok = protect_montexte($role);

    $sql = "INSERT INTO users (login, role) VALUES (?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $param_name, $param_role);

        $param_name = $login_ok;
        $param_role = $role_ok;

        if (mysqli_stmt_execute($stmt)) {

            header("location: ../archers_admin.php");
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

        <h1>Création d'un utilisateur</h1><br><br>

        <form method="post" class="cnx">
            <label>Votre 'nom.prénom'</label><br>
            <input type="text" placeholder="nom.prénom" name="pseudo" value="<?php echo $nom.'.'.$prenom ?>"><br><br>
            <label>Rôle ('ARCHER' ou 'ADMIN')</label><br>
            <input type="text" name="role" placeholder="rôle"><br><br>
            <input type="submit" name="submit" value="Créer">
            <a href="../archers_admin.php" class="btn btn-secondary ml-2">Annuler</a>
        </form>

        <div class="espace">

        </div>
    </div>
    <!-- <?php include './php/menu/footer.php' ?> -->
</body>

</html>