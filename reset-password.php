<?php
require_once './php/bdd/protection.php';

$err = false; 
$envemail='';

if(empty($_POST['email'])){
    $_SESSION['mail_error'] = "entrer un email";
    $err = true;
}else{
    $email_ok = protect_montexte( $_POST['email']);
    
    if(!filter_var($email_ok,FILTER_VALIDATE_EMAIL)){
        $email_ok = '';
        $_SESSION['mail_error'] = "mail invalide";
        $err = true;
    }
}

if(!$err){
    require_once './php/bdd/config.php';
    $token = str_random(60);

    $sql ="SELECT id FROM users WHERE email ='$email_ok'";
    $res= mysqli_query($link,$sql);
    if($res){
        $row=mysqli_fetch_all($res,MYSQLI_ASSOC);
    foreach ($row as $value){
          $user_id=$value['id'];
    }
    }else{
        echo 'un souci avec select ??';
    }

    $sql = " UPDATE users SET reset_psw='$token'  WHERE email='$email_ok'";
    $resstmt = mysqli_query($link, $sql);
    if(mysqli_query($link,$sql)){
        }else{
            echo"erreur de mise a jour reset token ligne 28!!!";
            die;
        }

        $chemin = 'https.//archersdeguignicourt.fr/token-reset.php';
        $entete = 'MIME-Version: 1.0'."\r\n";
        $entete .= 'Content-type: text/html; charset=utf-8'."\r\n";
        $entete .= 'From: contact@archersdeguignicourt.fr'."\r\n";
        $entete .= 'Reply-to: '.$email_ok;
        if(
            mail($email_ok, 
            "Changement de mot de passe",  
            "Afin de changer votre mot de passe , merci de cliquer sur ce lien\n\n".$chemin."?id=$user_id&token=$token",
            $entete )
        ){
            echo "Email envoyé";
        }else{
            echo "Erreur d'envoi E-Mail";
            die;
        }
    $envemail = "si votre adresse e-mail est bonne vous recevrez un e-mail";

}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require_once './php/menu/head.php' ?>
    <title>Mot de passe oublie</title>
</head>
<body>
    <?php require_once './php/menu/menu.php'; ?>
   
    <h1>Mot de passe oublié </h1>
        <form method="post">
            <fieldset>
                <p>
                    <label for="email">E-mail donné à votre inscription</label><br>
                </p>
                <p>
                    <input id="email" name="email" type="text" placeholder="entrez l'émail concerné" required="">       
                </p>
                <button id="btn_submit" name="btn_submit" class="btn btn-primary" value="connexion">envoyer</button>
                <?php if($envemail) : ?>                                  
                    <p>
                        <?= $envemail ?>
                        <a href="./index.php" style="text-decoration:none; color:white; " >Accueil</a>
                    </p> 
                <?php endif ?>
            </fieldset>
        </form>
    </main>

    <?php require_once './php/menu/footer.php'; ?>
</body>
</html>