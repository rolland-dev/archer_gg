<?php
session_start();

if (isset($_GET['choix'])) {
    $choix = $_GET['choix'];
} else {
    $choix = '';
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = '';
}
$compte = 1;

if($choix == 'Plume blanche') $compte =1;
if($choix == 'Plume noire') $compte =2;
if($choix == 'Plume bleu') $compte =3;
if($choix == 'Plume rouge') $compte =4;
if($choix == 'Plume jaune') $compte =5;

if($choix == 'Fleche blanche') $compte =1;
if($choix == 'Fleche noire') $compte =1;
if($choix == 'Fleche bleu') $compte =1;
if($choix == 'Fleche rouge') $compte =1;
if($choix == 'Fleche jaune') $compte =1;

for ($i=1; $i <= $compte ; $i++) { 
    require_once "../../php/bdd/config.php";
    $param_date = date("Y-m-d");
    $param_valide = true;
    $id = $id;
    $choix =$choix;
    $val = 0;
    // var_dump($compte);die;
    $sql = "INSERT INTO passage (id_archer, created_at, couleur, nbtir ,col1,col2,col3,col4,col5,col6, isValide) VALUES ( '$id', '$param_date', '$choix','$i' ,'$val','$val','$val','$val','$val','$val', '$param_valide')";
            
        $result = mysqli_query($link, $sql);
        if($result){
            
            
        } else{
            echo "Oops! erreur inattendu, rééssayez ultérieusement";
        }
    }
    mysqli_close($link);
    header("location: ../passage_admin.php");
    exit();
    
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>create Record</title>
   
</head>
<body>
  
</body>
</html>