<?php
session_start();

require_once "./php/bdd/protection.php";

if(isset($_POST['pseudo'])){
    $pseudo=$_POST['pseudo'];
}else{
    $_SESSION['erreur'].='champ pseudo vide';
    header('location:inscription.php');
    exit();
}
if(isset($_POST['email'])){
    $email=$_POST['email'];
}else{
    $_SESSION['erreur'].='champ email vide';
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
if(isset($_POST['cgu'])){
    $cgu=true;
}else{
    $_SESSION['erreur'].='cochez les cgu';
    header('location:inscription.php');
    exit();
}
require_once "./php/bdd/config.php";

$login_ok=protect_montexte($pseudo);
$email_ok=protect_montexte($email);
$password_ok=protect_montexte($password);

// vérification de l'email

$sql = "select * from users where email= '$email_ok'";

if($test=mysqli_query($link,$sql)){
    if(mysqli_num_rows($test) == 0){
        $_SESSION['msg_erreur']= "compte inconnu !!!";
        header("Location: ./inscription.php");
        exit();
    }
}

$pass= password_hash($password_ok , PASSWORD_DEFAULT );

$sql = "UPDATE users SET mdp=?, cgu=? WHERE login=?";
        
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sis", $param_pass, $param_cgu, $param_name);
            
            $param_name = $login_ok;
            $param_cgu = $cgu;
            $param_pass = $pass;
            
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['msg_erreur']="";
                header("location: ./index.php");
                exit();
            }
        }
?>