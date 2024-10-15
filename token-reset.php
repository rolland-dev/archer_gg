<?php
session_start();

require_once './php/bdd/protection.php';

$id = $_GET['id'];
$token = str_replace(array("'", "\""), '',$_GET['token']);

if(isset($_GET['id']) && isset($_GET['token'])){    
    require_once './php/bdd/config.php';
    $sql = "SELECT * FROM users WHERE reset_psw ='$token'";
   
    if ($result = mysqli_query($link, $sql)) {
        
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {

            if($row['id'] == $id && $row['reset_psw'] == $token){
                $_SESSION['id'] = $_GET['id'];
                $_SESSION['autoriser'] = 'ok';
                $sql = "UPDATE users SET reset_psw = NULL WHERE id = '$id'";

                if(mysqli_query($link, $sql)){
                    header('Location: ./change-mdp.php');
                }else {
                    echo 'erreur de update<br>';
                }
            

            }else{
                die('Ce token n\'est plus valide.');
            }
        }
        }else{
            header('location:./index.php');
        } 
    }
}
?>