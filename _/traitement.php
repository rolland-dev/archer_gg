<?php
session_start();
$_SESSION['erreur']='';
$_SESSION['login']='';
$_SESSION['nom']='';
$_SESSION['role']='';

require_once ('./php/bdd/protection.php');

$erreur='';

if(isset($_POST['login'])){
    $login=$_POST['login'];
}else{
    $_SESSION['erreur'].='champ login vide';
    header('location:login.php');
    exit();
}
if(isset($_POST['password'])){
    $password=$_POST['password'];
}else{
    $_SESSION['erreur'].='champ passeword vide';
    header('location:login.php');
    exit();
}
require_once "./php/bdd/config.php";

$login_ok=protect_montexte($login);
$password_ok=protect_montexte($password);

$sql = "SELECT * FROM users";

if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {

            $sql1 = "SELECT * FROM archers";
            if ($result1 = mysqli_query($link, $sql1)) {
                if (mysqli_num_rows($result1) > 0) {
                    while ($row1 = mysqli_fetch_array($result1)) {

                    $valide_archer=$row1['valide'];

                if (($login_ok == $row['login']) && (password_verify($password_ok,$row['mdp'])) && ($row1['valide']==true)) {
                    $_SESSION['login']="yes";
                    $_SESSION['nom']=$row['login'];
                    $_SESSION['role']=$row['role'];
                    $_SESSION['archer_id']=$row['archer_id'];
                    $valide="ok";
                    header('location: ./index.php');
                    exit();
                }
                if (($login_ok == $row['login']) && (password_verify($password_ok,$row['mdp'])) && ($row['role']=='ADMIN')) {
                    $_SESSION['login']="yes";
                    $_SESSION['nom']=$row['login'];
                    $_SESSION['role']=$row['role'];
                    $_SESSION['archer_id']=$row['archer_id'];
                    $valide="ok";
                    header('location: ./index.php');
                    exit();
                }
               
        }}}}
        if($valide_archer !=true){
            $_SESSION['erreur'].= "<h3>Compte désactivé !!!</h3>";
            header('location: ./login.php');
            exit();
        }
        if($valide !="ok"){
            $_SESSION['erreur'].= "Login ou mot de passe incorrect !!!";
            header('location: ./login.php');
            exit();
        }
    }
}
?>