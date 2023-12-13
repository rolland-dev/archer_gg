<?php
require_once "./php/bdd/protection.php";

if(isset($_POST['pseudo'])){
    $pseudo=$_POST['pseudo'];
}else{
    $_SESSION['erreur'].='champ pseudo vide';
    header('location:inscription.php');
    exit();
}
if(isset($_POST['password'])){
    $password=$_POST['password'];
}else{
    $_SESSION['erreur'].='champ passeword vide';
    header('location:inscription.php');
    exit();
}

require_once "./php/bdd/config.php";

$login_ok=protect_montexte($pseudo);
$password_ok=protect_montexte($password);

$pass= password_hash($password_ok , PASSWORD_DEFAULT );

$sql = "INSERT INTO users (login, mdp, role) VALUES (?, ?, ?)";
        
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_pass, $param_role);
            
            $param_name = $login_ok;
            $param_pass = $pass;
            $param_role = "USER";
            
            if (mysqli_stmt_execute($stmt)) {
                
                header("location: ./index.php");
                exit();
            }
        }
?>