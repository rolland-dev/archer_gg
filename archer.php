<?php
session_start();

if(isset($_SESSION['role'])){
    $role = $_SESSION['role'];
}else{
    $role = '';
}
if(isset($_SESSION['nom'])){
    $nom = $_SESSION['nom'];
}else{
    $nom = '';
}

if($role == ''){
    header("Location: ./index.php");
}

session_abort();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once './php/menu/head.php' ?>
    <title>Archers</title>
</head>
<body>
    <?php require_once './php/menu/menu.php'; ?>

    <h1 class="text-center">Mon compte : <?= $nom ?></h1>


    <?php require_once './php/menu/footer.php'; ?>
</body>
</html>