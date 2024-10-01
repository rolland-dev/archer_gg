<?php

require_once "../../php/bdd/protection.php";

$nom = $_GET['nom'];
$prenom = $_GET['prenom'];
$email = $_GET['email'];
$archer_id = $_GET['id'];

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
        $_SESSION['erreur'] .= 'champ role vide';
        header('location: ./create_user.php');
        exit();
    }

    require_once "../../php/bdd/config.php";

    $login_ok = protect_montexte($pseudo);
    $role_ok = protect_montexte($role);
    $email_ok = protect_montexte($email);

    $sql = "INSERT INTO users (login,email, role, archer_id) VALUES (?,?, ?,?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_email, $param_role, $param_id);

        $param_name = $login_ok;
        $param_role = $role_ok;
        $param_email = $email_ok;
        $param_id = $archer_id;

        if (mysqli_stmt_execute($stmt)) {
            // envoi de mail
            ini_set( 'display_errors', 1 );
            error_reporting( E_ALL );
            $from = "contact@archersdeguignicourt.fr";
            $to = $email_ok;
            $subject = "Création de votre mot de passe ". $email_ok;
            $message = "Bonjour, afin de finaliser l'accés a votre compte archer, merci de vous rendre sur le site https://www.archersdeguignicourt.fr rubrique 'inscription' et de remplir les champs comme indiqués avec votre login suivant: ". $login_ok." .Cordialement l'équipe des Archers de Guignicourt.";
            $headers = "De :" . $from;
            mail($to,$subject,$message, $headers);
            echo "L'email a été envoyé.";
            // fin envoi mail

            $id = $_GET['id'];
            $sql = "UPDATE archers SET create_user=? WHERE id = '$id'";
    
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "i", $reset);
                $reset = true;
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Records deleted successfully. Redirect to landing page
                    header("location: ../archers_admin.php");
                    exit();
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }

            
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
            <input type="text" placeholder="nom.prénom" name="pseudo" value="<?php echo strtolower($nom).'.'.strtolower($prenom) ?>"><br><br>
            <label>Votre email</label><br>
            <input type="text" placeholder="email" name="email" value="<?php echo $email?>"><br><br>
            <label>Rôle ('ARCHER' ou 'ADMIN')</label><br>
            <input type="text" name="role" id="role" placeholder="rôle" onchange="checkForm()"><br><br>
            <input type="submit" name="submit" id="submit" value="Créer" class="btn btn-secondary ml-2" style="visibility:hidden;">
            <a href="../archers_admin.php" class="btn btn-secondary ml-2">Annuler</a>
        </form>

        <div class="espace">

        </div>
    </div>
    <script type="text/javascript">
    function checkForm(){
        console.log(document.getElementById('role').value.length);
        if(document.getElementById('role').value.length > 0){
            document.getElementById('submit').style.visibility="visible";
        }
    }
    </script>
    <!-- <?php include './php/menu/footer.php' ?> -->
</body>

</html>