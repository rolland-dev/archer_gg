<?php
session_start();
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
} else {
    $id = '';
}
if (isset($_SESSION['autoriser'])) {
    $autoriser = $_SESSION['autoriser'];
} else {
    $autoriser = '';
}
if(isset($_SESSION['verif_error'])){
    $verif_error = $_SESSION['verif_error'];
}else{
    $verif_error ='';
}
session_abort();

require_once './php/bdd/protection.php';

if($autoriser != 'ok'){
    header('location:./index.php');
}

$err=false;
if(isset($_POST['modifier'])){

    if(empty($_POST['password']) || strlen($_POST['password'])<8 ){
        $_SESSION['pass_error'] = 'mot de passe obligatoire (8 caractère minimum) ';
        $err = true;
    }else{
        if($_POST['password'] != $_POST['confirm_password']){
            $_SESSION['verif_error'] = 'les deux mots de passe ne sont pas identique ';
            $err = true;
        }else{
            $password = protect_montexte($_POST['password']);
        }
    }
    if(!$err){
        require_once './php/bdd/config.php';

        $password_ok = password_hash($password,PASSWORD_BCRYPT);

        $sql = " SELECT * FROM users WHERE id ='$id' ";
        $res = mysqli_query($link,$sql);
        $user = mysqli_fetch_array($res);
        $sql =" UPDATE users SET mdp = '$password_ok', reset_psw = NULL  WHERE id='$id' ";

        if(mysqli_query($link,$sql)){
            header('location:./login.php');
        }else{
            echo 'erreur UPDATE<br>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require_once './php/menu/head.php' ?>
    <title>Changement password</title>
</head>  
<body>
<?php require_once './php/menu/menu.php'; ?>
    <main>
        <h1> Changement de mot de passe </h1>
        <form action="" method="post">
            <fieldset>
                <legend>Nouveau mot de passe</legend>
                <p>
                    <label for="password">Mot de passe :</label>  
                </p>
                <p>
                    <input id="password" name="password" type="password" placeholder="entrez votre mot de passe"  required="">
                    
                </p>
                <p>
                    <label for="confirm_password">Confirme mot de passe :</label>
                </p>
                <p>
                    <input id="password" name="confirm_password" type="password" placeholder="entrez votre mot de passe" required="">
                    <span> <?php echo $verif_error; ?></span>
                </p>
                <p> 
                <input type="submit" name="modifier" value="modifier">
                <!--<button id="btn_modif" name="btn_modif" value="modifier">modifier</button>-->
            </fieldset>
        </form>
    </main>

</body>
</html>